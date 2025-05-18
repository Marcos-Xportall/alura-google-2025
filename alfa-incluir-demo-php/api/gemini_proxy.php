<?php
// HABILITAR PARA DEPURAÇÃO MÁXIMA NO AMBIENTE DE DESENVOLVIMENTO
error_reporting(E_ALL);
ini_set('display_errors', 1); // NÃO USE '1' EM PRODUÇÃO

header('Content-Type: application/json');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$response = [];

// Obter a chave da API da sessão do usuário
if (!isset($_SESSION['user_gemini_api_key']) || empty(trim($_SESSION['user_gemini_api_key']))) {
    http_response_code(401); // Unauthorized - ou 400 Bad Request se preferir
    $response['error'] = "CHAVE NÃO CONFIGURADA: Sua chave da API Gemini não foi inserida nesta sessão. Por favor, vá para 'Minha Conta' para configurá-la.";
    $response['action_required'] = "configure_api_key"; // Sinalizador para o JavaScript
    echo json_encode($response);
    exit();
}
$apiKey = trim($_SESSION['user_gemini_api_key']);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputJSON = file_get_contents('php://input');
    if ($inputJSON === false) {
        http_response_code(400);
        $response['error'] = "Não foi possível ler o corpo da requisição.";
        echo json_encode($response);
        exit();
    }

    $input = json_decode($inputJSON, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        $response['error'] = "JSON inválido no corpo da requisição: " . json_last_error_msg();
        echo json_encode($response);
        exit();
    }

    if (isset($input['prompt']) && !empty(trim($input['prompt']))) {
        $promptParaIA = trim($input['prompt']);
        $modelName = "gemini-1.5-flash-latest"; // Modelo recomendado pela Google para equilíbrio

        $geminiApiUrl = "https://generativelanguage.googleapis.com/v1beta/models/{$modelName}:generateContent?key=" . $apiKey;

        // ... (Restante da lógica cURL e processamento da resposta como estava antes) ...
        // O $data, $jsonData, $ch, etc., permanecem os mesmos
        $data = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $promptParaIA]
                    ]
                ]
            ],
            "generationConfig" => [
                "temperature" => 0.7, "topK" => 40, "topP" => 0.95, "maxOutputTokens" => 2048,
            ],
            "safetySettings" => [
                ["category" => "HARM_CATEGORY_HARASSMENT", "threshold" => "BLOCK_MEDIUM_AND_ABOVE"],
                ["category" => "HARM_CATEGORY_HATE_SPEECH", "threshold" => "BLOCK_MEDIUM_AND_ABOVE"],
                ["category" => "HARM_CATEGORY_SEXUALLY_EXPLICIT", "threshold" => "BLOCK_MEDIUM_AND_ABOVE"],
                ["category" => "HARM_CATEGORY_DANGEROUS_CONTENT", "threshold" => "BLOCK_MEDIUM_AND_ABOVE"],
            ]
        ];
        $jsonData = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $geminiApiUrl);
        // ... (todas as opções cURL) ...
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Manter true para segurança
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        // Se estiver no XAMPP Windows e tiver problemas de SSL, descomente e ajuste o caminho:
        // curl_setopt($ch, CURLOPT_CAINFO, "C:/xampp/php/extras/ssl/cacert.pem");


        $apiResponse = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErrorNumber = curl_errno($ch);
        $curlErrorMessage = curl_error($ch);
        curl_close($ch);

        if ($curlErrorNumber > 0) {
            http_response_code(500);
            $response['error'] = "Erro na chamada cURL para a API Gemini (cURL Error #{$curlErrorNumber}): " . $curlErrorMessage;
            if (strpos(strtolower($curlErrorMessage), 'ssl') !== false || strpos(strtolower($curlErrorMessage), 'certificate') !== false) {
                $response['error'] .= " (Pode ser um problema de certificado SSL. Verifique a configuração de CAINFO no PHP/cURL se estiver em ambiente local como XAMPP.)";
            }
        } elseif ($httpCode >= 200 && $httpCode < 300) {
            // ... (processamento da resposta da API como antes) ...
            $responseData = json_decode($apiResponse, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(500);
                $response['error'] = "Não foi possível decodificar a resposta JSON da API Gemini. Resposta crua: " . htmlentities(substr($apiResponse, 0, 500))."...";
            } elseif (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                $response['text'] = $responseData['candidates'][0]['content']['parts'][0]['text'];
            } elseif (isset($responseData['promptFeedback']['blockReason'])) {
                 http_response_code(400); // Mudado para 400, pois é um problema com o prompt/conteúdo
                 $blockReason = $responseData['promptFeedback']['blockReason'];
                 $safetyDetails = "";
                 if (isset($responseData['promptFeedback']['safetyRatings'])) {
                     foreach($responseData['promptFeedback']['safetyRatings'] as $rating) {
                         $safetyDetails .= $rating['category'] . ": " . $rating['probability'] . "; ";
                     }
                 }
                $response['error'] = "A IA bloqueou o prompt ou a resposta devido a: " . $blockReason . ". Detalhes: " . rtrim($safetyDetails, "; ");
            } else {
                http_response_code(500);
                $response['error'] = "Resposta inesperada ou texto ausente da API Gemini. Resposta crua: " . htmlentities(substr($apiResponse, 0, 500))."...";
            }
        } else {
            // ... (tratamento de erro da API como antes) ...
            http_response_code($httpCode);
            $apiErrorData = json_decode($apiResponse, true);
            $errorMessage = "Erro desconhecido da API Gemini.";
            if (isset($apiErrorData['error']['message'])) {
                $errorMessage = $apiErrorData['error']['message'];
            } elseif (!empty($apiResponse)) {
                $errorMessage = htmlentities(substr($apiResponse, 0, 500))."..."; // Limitar o tamanho da resposta crua no erro
            }
            $response['error'] = "Erro da API Gemini (HTTP {$httpCode}): " . $errorMessage;
        }


    } else {
        http_response_code(400);
        $response['error'] = "Nenhum prompt válido recebido.";
    }
} else {
    http_response_code(405);
    $response['error'] = "Método não permitido. Use POST.";
}

echo json_encode($response);
?>
