<?php
// Iniciar a sessão (o header.php também faz isso, mas é bom garantir aqui também)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// $basePath é definido no header.php, mas vamos definir um local para o redirect de segurança
$_localBasePath = '/alfa-incluir-demo-php'; // <<--- AJUSTE SE NECESSÁRIO (igual ao do header)

// Verifica se o usuário está logado
if (!isset($_SESSION['user_role'])) {
    header('Location: ' . $_localBasePath . '/login.php');
    exit;
}

// Obter informações do usuário da sessão
$userNameForGreeting = htmlspecialchars($_SESSION['user_greeting'] ?? $_SESSION['user_name'] ?? 'Usuário');
$userRole = ucfirst(strtolower($_SESSION['user_role'] ?? 'guest')); // Ex: 'Doméstico', 'Profissional', 'Admin'

// Determina a view a ser carregada e o título da página
$requested_view_key = $_GET['view'] ?? 'home'; // Padrão para 'home'

// Mapeamento de chaves de view para arquivos, títulos amigáveis e ícones
// O valor de 'file' é o caminho RELATIVO à pasta 'pages/dashboard/'
$views_config = [
    'home' => ['file' => null, 'title' => 'Painel Principal', 'icon' => 'bi-house-door-fill'], // 'home' é especial, seu conteúdo está nesta página
    
    // Comum ou Doméstico
    'gerador-atividades' => ['file' => 'geradorAtividades.html', 'title' => 'Gerar Atividades', 'icon' => 'bi-magic', 'roles' => ['Doméstico', 'Profissional', 'Admin']],
    'gerar-etiquetas' => ['file' => 'gerarEtiquetas.html', 'title' => 'Gerar Etiquetas Visuais', 'icon' => 'bi-tags-fill', 'roles' => ['Doméstico', 'Profissional', 'Admin']], // NOVA VIEW ADICIONADA
    'meus-filhos' => ['file' => 'meus-filhos.html', 'title' => 'Meus Filhos', 'icon' => 'bi-people-fill', 'roles' => ['Doméstico', 'Admin']],
    'recursos' => ['file' => 'recursos.html', 'title' => 'Recursos e Dicas', 'icon' => 'bi-book-half', 'roles' => ['Doméstico', 'Profissional', 'Admin']],
    'minha-conta' => ['file' => 'minha-conta.html', 'title' => 'Minha Conta', 'icon' => 'bi-person-circle', 'roles' => ['Doméstico', 'Profissional', 'Admin']],

    // Profissional
    'alunos' => ['file' => 'alunos.html', 'title' => 'Gerenciar Alunos', 'icon' => 'bi-person-lines-fill', 'roles' => ['Profissional', 'Admin']],
    'relatorios-prof' => ['file' => 'relatorios-prof.html', 'title' => 'Meus Relatórios', 'icon' => 'bi-graph-up', 'roles' => ['Profissional', 'Admin']],
    
    // Admin
    'admin/painel' => ['file' => 'admin/painel_admin.html', 'title' => 'Painel Administrativo', 'icon' => 'bi-shield-lock', 'roles' => ['Admin']],
    'admin/usuarios' => ['file' => 'admin/usuarios_admin.html', 'title' => 'Gerenciar Usuários', 'icon' => 'bi-person-fill-gear', 'roles' => ['Admin']],
    'admin/configuracoes' => ['file' => 'admin/configuracoes_admin.html', 'title' => 'Configurações do Sistema', 'icon' => 'bi-gear-fill', 'roles' => ['Admin']],
    'admin/teste-ia' => ['file' => 'admin/teste_ia_admin.html', 'title' => 'Teste da IA', 'icon' => 'bi-robot', 'roles' => ['Admin']],
    
    // Páginas de erro internas
    '404_view' => ['file' => '404_view.html', 'title' => 'Página Não Encontrada', 'icon' => 'bi-emoji-frown'],
    'access_denied' => ['file' => 'access_denied.html', 'title' => 'Acesso Negado', 'icon' => 'bi-shield-exclamation'],
];

$current_view_config = $views_config[$requested_view_key] ?? $views_config['404_view'];

// Verificação de permissão baseada em 'roles'
if (isset($current_view_config['roles']) && !in_array($userRole, $current_view_config['roles'])) {
    $current_view_config = $views_config['access_denied'];
    $requested_view_key = 'access_denied'; // Atualiza a chave para o estado ativo do link de navegação (se houver)
}

$pageTitle = $current_view_config['title'] . " | ALFA-INCLUIR";

// Inclui o header.php (que define $basePath globalmente)
include __DIR__ . '/partials/header.php';
?>

<div class="dashboard-main-content py-4">
    <div class="container">

        <?php if ($requested_view_key === 'home'): ?>
            <!-- Conteúdo da "Home" do Dashboard (Cards de Navegação) -->
            <div class="welcome-section text-center shadow-sm mb-5 p-4 p-md-5">
                <img src="https://images.squarespace-cdn.com/content/v1/5b939410f407b457934a287f/1557744081373-WIN3394FNPRAI8A6B7N3/common-1300520_1280.png" alt="Mascote Alfa no Dashboard" class="img-fluid mb-3" style="max-height: 120px;">
                <h1 class="display-5 fw-bold">Bem-vindo(a) de volta, <?php echo $userNameForGreeting; ?>!</h1>
                <p class="lead text-muted">Seu painel ALFA-INCLUIR. Explore as funcionalidades abaixo para começar.</p>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
                <?php
                // Gerar cards de navegação dinamicamente
                // Ordem dos cards pode ser definida aqui ou no array $views_config
                $navigation_order = [
                    'gerador-atividades',
                    'gerar-etiquetas', // NOVA VIEW ADICIONADA À ORDEM
                    ($userRole === 'Doméstico' ? 'meus-filhos' : 'alunos'),
                    'recursos',
                    'minha-conta',
                    'relatorios-prof', // Só aparecerá se for profissional
                    'admin/painel'     // Só aparecerá se for admin
                ];

                foreach ($navigation_order as $nav_key):
                    if (!isset($views_config[$nav_key])) continue; // Pula se a chave não existir (ex: 'alunos' para doméstico)

                    $card_data = $views_config[$nav_key];

                    // Verifica se o usuário tem permissão para este card/view
                    if (isset($card_data['roles']) && !in_array($userRole, $card_data['roles'])) {
                        continue; // Pula este card se não tiver permissão
                    }
                ?>
                <div class="col d-flex align-items-stretch">
                    <div class="card h-100 shadow-sm text-center dashboard-nav-card">
                        <div class="card-body d-flex flex-column p-4">
                            <div class="card-icon-dashboard mb-3 mt-2 text-primary" style="font-size: 3rem;">
                                <i class="bi <?php echo htmlspecialchars($card_data['icon']); ?>"></i>
                            </div>
                            <h3 class="card-title h5 fw-semibold mb-2"><?php echo htmlspecialchars($card_data['title']); ?></h3>
                            <?php
                            // Mantenha ou melhore estas descrições
                            $descriptions = [ 
                                'gerador-atividades' => 'Crie atividades personalizadas com o poder da IA.',
                                'gerar-etiquetas' => 'Crie e imprima etiquetas com imagens e texto para objetos do dia a dia.', // NOVA DESCRIÇÃO
                                'meus-filhos' => 'Gerencie os perfis e acompanhe o desenvolvimento dos seus filhos.',
                                'alunos' => 'Gerencie os perfis dos seus alunos e planeje intervenções.',
                                'recursos' => 'Acesse artigos, dicas e materiais de apoio selecionados.',
                                'minha-conta' => 'Atualize suas informações e preferências de conta.',
                                'relatorios-prof' => 'Visualize o progresso e insights sobre seus alunos.',
                                'admin/painel' => 'Acesse as ferramentas administrativas do sistema.'
                            ];
                            ?>
                            <p class="card-text text-muted small flex-grow-1 mb-3"><?php echo $descriptions[$nav_key] ?? 'Explore esta funcionalidade.'; ?></p>
                            <a href="<?php echo $basePath; ?>/dashboard/<?php echo $nav_key; ?>" class="btn btn-outline-primary mt-auto stretched-link">
                                Acessar <i class="bi bi-arrow-right-short"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h4 class="mb-0 fw-normal"><i class="bi bi-lightbulb-fill me-2 text-warning"></i>Dica do Dia ALFA-INCLUIR</h4>
                </div>
                <div class="card-body">
                    <p class="mb-0"><strong>Mantenha a rotina, mas seja flexível!</strong> Crianças, especialmente no espectro autista, beneficiam-se de rotinas previsíveis, mas também é importante adaptar-se às suas necessidades e interesses do momento.</p>
                </div>
            </div>

        <?php else: // Se $requested_view_key NÃO é 'home', carrega a view específica ?>
            <div class="view-content-wrapper bg-white p-md-4 p-3 rounded shadow-sm">
                <?php
                // Constrói o caminho para o arquivo da view CORRETAMENTE
                // O valor de 'file' em $current_view_config já inclui subpastas como 'admin/'
                $view_file_path = __DIR__ . '/pages/dashboard/' . $current_view_config['file'];

                // Cabeçalho da View com Título e Breadcrumb/Voltar
                echo '<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom view-header">';
                echo '  <h2 class="h3 mb-0 text-primary"><i class="bi ' . htmlspecialchars($current_view_config['icon'] ?? 'bi-file-earmark-text') . ' me-2"></i>' . htmlspecialchars($current_view_config['title']) . '</h2>';
                echo '  <a href="' . $basePath . '/dashboard/home" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left-circle me-1"></i>Voltar ao Painel</a>';
                echo '</div>';

                if (file_exists($view_file_path)) {
                    include $view_file_path; // AQUI A VIEW ESPECÍFICA (EX: geradorAtividades.html) É INCLUÍDA
                } else {
                    // Trata o caso de arquivo da view não encontrado (diferente de acesso negado ou view não mapeada)
                    $error_file_path_404_view = __DIR__ . '/pages/dashboard/' . ($views_config['404_view']['file'] ?? '404_view.html');
                    if (file_exists($error_file_path_404_view) && $current_view_config['file'] !== $views_config['404_view']['file']) { // Evita loop se 404_view.html não existir
                        echo '<div class="alert alert-warning">O conteúdo específico para <strong>"' . htmlspecialchars($current_view_config['title']) . '"</strong> não foi encontrado. Exibindo página de erro.</div>';
                        include $error_file_path_404_view;
                    } else {
                        echo '<div class="alert alert-danger mt-4">';
                        echo '  <strong>Erro Interno Grave:</strong> Arquivo da view principal não encontrado e página de erro padrão também ausente.';
                        echo '  <p class="mb-0 small mt-2">Caminho esperado para view: <code>' . htmlspecialchars($view_file_path) . '</code></p>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        <?php endif; ?>

    </div> <!-- Fim .container -->
</div> <!-- Fim .dashboard-main-content -->

<?php
// Inclui o footer.php
include __DIR__ . '/partials/footer.php';
?>