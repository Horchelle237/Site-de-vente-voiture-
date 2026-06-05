<?php /** @var string $pageTitle */ ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle ?? 'Administration') ?> · <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?= asset('css/style.css') ?>" rel="stylesheet">
</head>
<body class="admin-body">
<?php
    // Détecte l'URL courante pour activer le bon item du menu
    $currentUrl = strtok($_SERVER['REQUEST_URI'] ?? '', '?');
    $isActive   = fn(string $needle): string => str_contains($currentUrl, $needle) ? 'active' : '';
?>

<div class="admin-layout">
    <!-- ============== SIDEBAR ============== -->
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-gem text-gold"></i>
            <span>Euro<strong>Auto</strong></span>
        </div>

        <div class="sidebar-user">
            <div class="user-avatar">
                <?= strtoupper(mb_substr($_SESSION['admin_name'] ?? 'A', 0, 1)) ?>
            </div>
            <div>
                <div class="user-name"><?= e($_SESSION['admin_name'] ?? 'Admin') ?></div>
                <div class="user-role">Administrateur</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="<?= url('admin/dashboard') ?>" class="nav-item <?= $isActive('dashboard') ?>">
                <i class="bi bi-speedometer2"></i><span>Tableau de bord</span>
            </a>
            <a href="<?= url('admin/vehicules') ?>" class="nav-item <?= $isActive('vehicule') ?>">
                <i class="bi bi-car-front"></i><span>Véhicules</span>
            </a>
            <a href="<?= url('admin/messages') ?>" class="nav-item <?= $isActive('message') ?>">
                <i class="bi bi-envelope"></i><span>Messages</span>
            </a>
            <a href="<?= url('admin/temoignages') ?>" class="nav-item <?= $isActive('temoignage') ?>">
                <i class="bi bi-chat-quote"></i><span>Témoignages</span>
            </a>

            <div class="sidebar-divider"></div>

            <a href="<?= url('') ?>" class="nav-item" target="_blank">
                <i class="bi bi-box-arrow-up-right"></i><span>Voir le site</span>
            </a>
            <a href="<?= url('admin/logout') ?>" class="nav-item nav-logout">
                <i class="bi bi-box-arrow-right"></i><span>Déconnexion</span>
            </a>
        </nav>
    </aside>

    <!-- ============== MAIN ============== -->
    <main class="admin-main">
        <header class="admin-topbar">
            <h1 class="topbar-title"><?= e($pageTitle ?? 'Administration') ?></h1>
            <div class="topbar-meta text-muted small">
                <i class="bi bi-clock me-1"></i>
                <?= ucfirst(strftime('%A %d %B %Y', time())) ?: date('d/m/Y') ?>
            </div>
        </header>

        <div class="admin-content">
            <?= flash_messages() ?>
