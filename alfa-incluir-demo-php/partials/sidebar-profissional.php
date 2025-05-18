<?php $linkPrefix = $basePath ?? ''; // Vem do header.php ou defina aqui ?>
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link <?php echo ($requested_view_key ?? 'home') === 'home' ? 'active' : ''; ?>" href="<?php echo $linkPrefix; ?>/dashboard/home">Visão Geral</a>
    </li>
    ...
</ul>