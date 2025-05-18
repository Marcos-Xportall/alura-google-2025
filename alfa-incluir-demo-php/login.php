<?php
// Iniciar a sessão
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Definição dos perfis mock
$mockUserProfiles = [
    'admin' => ['name' => 'Admin AlfaIncluir', 'role' => 'Admin', 'greeting' => 'Administrador'],
    'profissional' => ['name' => 'Dr(a). Silva', 'role' => 'Profissional', 'greeting' => 'Profissional'],
    'domestico' => ['name' => 'Família Alfa', 'role' => 'Doméstico', 'greeting' => 'Responsável'],
];

// Definir o caminho base
$basePath = '/alfa-incluir-demo-php'; // Ajuste se o nome da sua pasta raiz do projeto for diferente

// Se já estiver logado, redirecionar para o dashboard
if (isset($_SESSION['user_role'])) {
    header('Location: ' . $basePath . '/dashboard.php?view=home');
    exit();
}

$pageTitle = "Login - ALFA-INCLUIR";
$loginError = null;

// Processar a tentativa de login fake via parâmetro GET
if (isset($_GET['sim_role'])) {
    $selectedRoleKey = $_GET['sim_role'];

    // Permitir login apenas para 'domestico' nesta versão modificada
    if ($selectedRoleKey === 'domestico' && array_key_exists($selectedRoleKey, $mockUserProfiles)) {
        $_SESSION['user_role'] = $mockUserProfiles[$selectedRoleKey]['role'];
        $_SESSION['user_name'] = $mockUserProfiles[$selectedRoleKey]['name'];
        $_SESSION['user_greeting'] = $mockUserProfiles[$selectedRoleKey]['greeting'];

        // Redireciona para o dashboard
        header('Location: ' . $basePath . '/dashboard.php?view=home');
        exit();
    } elseif (array_key_exists($selectedRoleKey, $mockUserProfiles)) {
        // Se for um perfil válido mas não 'domestico', exibe erro de perfil desabilitado
        $loginError = "O perfil de '" . htmlspecialchars($mockUserProfiles[$selectedRoleKey]['role']) . "' está temporariamente desabilitado nesta demonstração.";
    } else {
        $loginError = "Perfil de simulação inválido ('" . htmlspecialchars($selectedRoleKey) . "') selecionado.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo htmlspecialchars($basePath); ?>/css/style.css?v=<?php echo filemtime(__DIR__ . '/css/style.css'); ?>">

    <script>
        window.APP_BASE_PATH = "<?php echo htmlspecialchars($basePath, ENT_QUOTES, 'UTF-8'); ?>";
        // console.log("PHP definiu APP_BASE_PATH como:", window.APP_BASE_PATH);
    </script>

    <style>
        :root { 
            --navbar-height: 70px; 
            /* Adicione suas variáveis de cor de style.css se necessário para consistência */
            --cor-primaria: #007bff; 
            --cor-secundaria: #6c757d;
        }
        html, body { height: 100%; }
        body { 
            padding-top: var(--navbar-height); 
            display: flex; 
            flex-direction: column; 
            background-color: #f8f9fa; /* Um fundo suave para a página de login */
        }
        main { 
            flex-grow: 1; 
            display: flex;
            align-items: center; /* Centraliza o card verticalmente */
        }
        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }
        .login-form-container .card-header h3 {
            font-family: 'Poppins', sans-serif;
        }
        .login-form-container .btn {
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
        /* Estilo para botões desabilitados */
        .btn.disabled-look, .btn:disabled {
            background-color: #e9ecef; /* Cinza claro */
            border-color: #ced4da;
            color: #6c757d; /* Texto cinza */
            cursor: not-allowed;
            opacity: 0.65;
        }
        .btn.disabled-look:hover, .btn:disabled:hover {
            background-color: #e9ecef;
            border-color: #ced4da;
            color: #6c757d;
        }
    </style>
</head>
<body class="logged-out page-login">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm" style="min-height: var(--navbar-height);">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo htmlspecialchars($basePath); ?>/index.php">
                ALFA-INCLUIR
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo htmlspecialchars($basePath); ?>/index.php">
                            <i class="bi bi-house-door-fill me-1"></i>Início
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        <div class="row justify-content-center w-100">
            <div class="col-md-7 col-lg-6 col-xl-5">
                <div class="card shadow-lg login-form-container border-0">
                    <div class="card-header text-center bg-primary text-white py-3">
                        <h3 class="mb-0 fw-semibold">Acesse o Ambiente de Demonstração</h3>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <?php if ($loginError): ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo htmlspecialchars($loginError); ?>
                            </div>
                        <?php endif; ?>
                        <p class="text-center mb-4 text-muted">Selecione o perfil abaixo para experimentar o ALFA-INCLUIR como responsável:</p>
                        <div class="d-grid gap-3">
                            <button type="button" class="btn btn-lg btn-info text-dark shadow-sm" onclick="javascript:loginAs('domestico')">
                                <i class="bi bi-house-heart-fill me-2"></i> Sou Pai / Cuidador
                            </button>
                            <button type="button" class="btn btn-lg btn-success shadow-sm disabled-look" onclick="javascript:void(0)" disabled title="Perfil Profissional desabilitado nesta demonstração">
                                <i class="bi bi-mortarboard-fill me-2"></i> Sou Profissional (Desabilitado)
                            </button>
                            <hr class="my-3">
                            <button type="button" class="btn btn-sm btn-outline-secondary w-100 disabled-look" onclick="javascript:void(0)" disabled title="Acesso Administrador desabilitado nesta demonstração">
                                <i class="bi bi-shield-lock-fill me-1"></i> Acesso Administrador (Desabilitado)
                            </button>
                        </div>
                         <p class="text-center mt-4 mb-0 small text-muted">
                            Esta é uma versão de demonstração simplificada.<br>
                            Perfis de Profissional e Administrador estão desabilitados.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white py-4 mt-auto footer-alfa"> {/* Adicionada classe footer-alfa */}
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="mb-3 text-uppercase"><i class="bi bi-gem me-2"></i>ALFA-INCLUIR</h5>
                    <p class="small text-white-50">Empoderando o desenvolvimento infantil com inteligência e colaboração. Criado com <i class="bi bi-heart-fill text-danger"></i> para todas as crianças.</p>
                     <p class="small text-muted mt-2">© <?php echo date("Y"); ?> ALFA-INCLUIR Demo. Todos os direitos reservados.</p>
                </div>
                <div class="col-md-3 col-6">
                    <h6 class="text-uppercase mb-3 fw-semibold">Navegação</h6>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo htmlspecialchars($basePath); ?>/index.php" class="text-white-50 footer-link">Início</a></li>
                        <li><a href="#" class="text-white-50 footer-link">Sobre o Projeto</a></li>
                        <li><a href="<?php echo htmlspecialchars($basePath); ?>/index.php#sobre-autismo" class="text-white-50 footer-link">Sobre o TEA</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-6">
                    <h6 class="text-uppercase mb-3 fw-semibold">Contato</h6>
                     <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 footer-link">Suporte</a></li>
                        <li><a href="#" class="text-white-50 footer-link">FAQ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function loginAs(role) {
            // console.log("Login simples com role:", role);
            const basePath = window.APP_BASE_PATH || '/alfa-incluir-demo-php'; // Fallback, mas deve ser definido
            if (role === 'domestico') { // Apenas permitir login para 'domestico' via JS também
                window.location.href = basePath + '/login.php?sim_role=' + encodeURIComponent(role);
            } else {
                alert('O perfil selecionado está desabilitado nesta demonstração.');
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- app.js não é estritamente necessário para a funcionalidade de login desta página, mas pode ser mantido se houver outras lógicas globais -->
    <!-- <script src="<?php echo htmlspecialchars($basePath); ?>/js/app.js?v=<?php echo filemtime(__DIR__ . '/js/app.js'); ?>"></script> -->
</body>
</html>