    <!-- Conteúdo da página principal (main ou .dashboard-main-content) já foi renderizado -->

    <footer class="bg-dark text-white py-4 mt-auto footer-alfa"> 
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
                        <?php // $basePath deve estar definido no header.php e acessível aqui ?>
                        <li><a href="<?php echo $basePath; ?>/index.php" class="text-white-50 footer-link">Início</a></li>
                        <li><a href="<?php echo $basePath; ?>/dashboard/home" class="text-white-50 footer-link">Painel</a></li>
                        <li><a href="<?php echo $basePath; ?>/index.php#sobre-autismo" class="text-white-50 footer-link">Sobre o TEA</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-6">
                    <h6 class="text-uppercase mb-3 fw-semibold">Contato</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 footer-link">Suporte</a></li>
                        <li><a href="#" class="text-white-50 footer-link">FAQ</a></li>
                        <li><a href="#" class="text-white-50 footer-link">Parcerias</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle (Popper.js incluído) (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php
    $footerBasePath = $basePath ?? '/alfa-incluir-demo-php'; 
    ?>

    <!-- 0. BIBLIOTECAS DE TERCEIROS PRIMEIRO -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- 1. DADOS MOCKADOS (se app.js ou extraJs dependerem deles) -->
    <script src="<?php echo $footerBasePath; ?>/js/mockData.js?v=<?php echo filemtime(__DIR__ . '/../js/mockData.js'); ?>"></script>
    
    <!-- 2. SEU SCRIPT PRINCIPAL DA APLICAÇÃO -->
    <script src="<?php echo $footerBasePath; ?>/js/app.js?v=<?php echo filemtime(__DIR__ . '/../js/app.js'); ?>"></script>

    <?php // Scripts extras específicos da página (definidos pela página que inclui este footer) ?>
    <?php // Estes scripts agora podem usar html2pdf e app.js ?>
    <?php if (isset($extraJs) && is_array($extraJs)): ?>
        <?php foreach ($extraJs as $jsFile): ?>
            <script src="<?php echo $footerBasePath; ?>/js/<?php echo htmlspecialchars($jsFile); ?>?v=<?php echo filemtime(__DIR__ . '/../js/' . $jsFile); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php
        // Se o script da página de etiquetas estiver inline no arquivo .html dela (como no exemplo completo que forneci),
        // ele será executado após todos esses scripts do footer, o que é o correto,
        // pois nesse ponto html2pdf.js já estará carregado.
    ?>
</body>
</html>