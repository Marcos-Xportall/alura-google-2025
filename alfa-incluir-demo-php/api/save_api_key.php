<?php
// api/save_api_key.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: application/json');
$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    if (isset($input['apiKey'])) {
        $apiKey = trim($input['apiKey']);
        if (!empty($apiKey)) {
            $_SESSION['user_gemini_api_key'] = $apiKey;
            $response['success'] = true;
        } else {
            $response['error'] = "A chave da API não pode estar vazia.";
        }
    } else {
        $response['error'] = "Nenhuma chave da API recebida.";
    }
} else {
    http_response_code(405);
    $response['error'] = "Método não permitido.";
}
echo json_encode($response);
?>