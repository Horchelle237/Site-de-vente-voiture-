<?php
/** @var string $pageTitle */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="EuroAuto - Vente de véhicules d'occasion premium en Île-de-France. Découvrez notre sélection de berlines, SUV et sportives.">
    <title><?= e($pageTitle ?? 'Accueil') ?> · <?= APP_NAME ?></title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">

    <!-- Polices -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;900&family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- AOS - animations au scroll -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Feuille de style maison -->
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
    <link rel="icon" type="image/svg+xml" href="<?= asset('images/favicon.svg') ?>">
</head>
<body>

<!-- ====== NAVBAR ====== -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top euroauto-navbar" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="<?= url('/') ?>">
            <span class="brand-mark">
                <i class="bi bi-fuel-pump-fill"></i>
            </span>
            <span class="brand-text">
                Euro<span class="text-warning">Auto</span>
            </span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="<?= url('/') ?>">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('vehicules') ?>">Véhicules</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('a-propos') ?>">À propos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('temoignages') ?>">Témoignages</a></li>
                <li class="nav-item">
                    <a class="btn btn-warning btn-sm fw-semibold ms-lg-3 px-3" href="<?= url('contact') ?>">
                        Nous contacter <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ====== Messages flash ====== -->
<?php if (!empty($_SESSION['flash'])): ?>
<div class="container mt-3">
    <?= flash_messages() ?>
</div>
<?php endif; ?>

<main>
