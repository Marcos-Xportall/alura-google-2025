 <li class="nav-item">
        <a class="nav-link <?php echo ($current_view === 'home') ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/dashboard.php?view=home">
            <i class="bi bi-house-door-fill me-2"></i>Painel Principal
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_view === 'alunos') ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/dashboard.php?view=alunos">
            <i class="bi bi-people-fill me-2"></i>Meus Filhos/Alunos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_view === 'geradorAtividades') ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/dashboard.php?view=geradorAtividades">
            <i class="bi bi-magic me-2"></i>Gerar Atividades
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_view === 'recursos') ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/dashboard.php?view=recursos">
            <i class="bi bi-book-half me-2"></i>Recursos
        </a>
    </li>
</ul>

<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
    <span>Conta</span>
</h6>
<ul class="nav flex-column mb-2">
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_view === 'minhaConta') ? 'active' : ''; ?>" href="<?php echo $basePath; ?>/dashboard.php?view=minhaConta">
            <i class="bi bi-person-fill-gear me-2"></i>Minha Conta
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo $basePath; ?>/logout.php">
            <i class="bi bi-box-arrow-right me-2"></i>Sair
        </a>
    </li>
</ul>