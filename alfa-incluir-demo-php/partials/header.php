<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['user_role']);
$userNameForGreeting = '';
if ($isLoggedIn) {
    $userNameForGreeting = htmlspecialchars($_SESSION['user_greeting'] ?? $_SESSION['user_name'] ?? 'Usuário');
}
$currentPage = basename($_SERVER['PHP_SELF']);
$pageTitle = isset($pageTitle) ? htmlspecialchars($pageTitle) : "ALFA-INCLUIR";

// ---- CAMINHO BASE CORRETO PARA SUA ESTRUTURA ----
$basePath = '/alfa-incluir-demo-php'; // Mantenha o seu base path correto
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> <!-- Adicionado para impedir zoom -->
    <title><?php echo $pageTitle; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?php echo $basePath; ?>/css/style.css?v=<?php echo filemtime(__DIR__ . '/../css/style.css'); ?>">

    <?php if (isset($extraCss) && is_array($extraCss)): ?>
        <?php foreach ($extraCss as $cssFile): ?>
            <link rel="stylesheet" href="<?php echo $basePath; ?>/css/<?php echo htmlspecialchars($cssFile); ?>?v=<?php echo filemtime(__DIR__ . '/../css/' . $cssFile); ?>">
        <?php endforeach; ?>
    <?php endif; ?>

    <script>
        window.APP_BASE_PATH = "<?php echo htmlspecialchars($basePath, ENT_QUOTES, 'UTF-8'); ?>";
        // console.log("PHP definiu APP_BASE_PATH como:", window.APP_BASE_PATH); // Pode remover ou manter para debug
    </script>

    <style>
        :root { 
            --navbar-height: 70px; 
            --ai-disclaimer-height: auto; /* Será definido por JS se necessário, ou pode ser fixo */
        }
        /* Ajuste no padding-top do body para acomodar a navbar E o disclaimer */
        body { 
            padding-top: calc(var(--navbar-height) + var(--ai-disclaimer-height)); /* Inicialmente 70px + altura do disclaimer */
            /* Se o disclaimer não for fixo, apenas var(--navbar-height) é necessário aqui */
        }
        html, body { height: 100%; }
        body { display: flex; flex-direction: column; }
        main, .dashboard-layout { flex-grow: 1; }

        /* Estilo para o disclaimer de IA (Adicionado) */
        #ai-data-disclaimer {
            background-color: #cfe2ff; /* cor-primaria-clara do seu CSS, ou use var() se o CSS carregar antes */
            color: #212529; /* cor-texto-escuro */
            border: none;
            font-weight: 500;
            border-radius: 0;
            font-size: 0.8rem;
            z-index: 1029; /* Abaixo da navbar (1030), mas acima do conteúdo normal */
            /* Removido position:fixed para que flua com o conteúdo abaixo da navbar */
            /* Se quiser fixo ABAIXO da navbar, seria mais complexo com JS para ajustar a posição */
        }
        #ai-data-disclaimer strong {
            color: #0056b3; /* cor-primaria-escura */
        }
    </style>
</head>
<body class="<?php echo $isLoggedIn ? 'logged-in' : 'logged-out'; ?> <?php echo 'page-' . str_replace('.php', '', $currentPage); ?>">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="min-height: var(--navbar-height);">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo $basePath; ?><?php echo $isLoggedIn ? '/dashboard.php?view=home' : '/index.php'; ?>">
                ALFA-INCLUIR
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <?php if (!$isLoggedIn && $currentPage !== 'index.php' && $currentPage !== 'login.php'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $basePath; ?>/index.php">
                                <i class="bi bi-house-door-fill me-1"></i>Início
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item">
                            <span class="navbar-text me-3"><i class="bi bi-person-circle me-1"></i>Olá, <?php echo $userNameForGreeting; ?>!</span>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $basePath; ?>/logout.php" class="btn btn-outline-light btn-sm">
                                <i class="bi bi-box-arrow-right me-1"></i>Sair
                            </a>
                        </li>
                    <?php elseif ($currentPage !== 'login.php'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $basePath; ?>/login.php">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login / Acessar Demo
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ADICIONADO: Mensagem de Aviso sobre Dados de IA -->
    <div class="alert alert-info small text-center mb-0 py-2" role="alert" id="ai-data-disclaimer">
        <div class="container"> <!-- Para alinhar com o conteúdo da página -->
            <i class="fas fa-info-circle me-1"></i>
            <strong>Aviso Importante:</strong> Os nomes, descrições e outras informações exemplificativas neste sistema são gerados por Inteligência Artificial para fins ilustrativos e não correspondem a dados de pessoas reais.
        </div>
    </div>
    <!-- FIM DA MENSAGEM DE AVISO -->

    <!-- O conteúdo principal (main) virá aqui, após o header ser incluído -->