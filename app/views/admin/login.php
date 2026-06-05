<?php /** @var string $csrf @var string $pageTitle */ ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?> · <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <link href="<?= asset('css/style.css') ?>" rel="stylesheet">
</head>
<body class="admin-login-page">
    <div class="login-wrapper">
        <div class="login-card" data-aos="zoom-in">
            <div class="login-brand">
                <i class="bi bi-shield-lock-fill"></i>
                <h1 class="brand-title">Euro<span class="text-gold">Auto</span></h1>
                <p class="brand-subtitle">Espace administrateur sécurisé</p>
            </div>

            <?= flash_messages() ?>

            <form method="post" action="<?= url('admin/login') ?>">
                <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= e($csrf) ?>">

                <div class="form-floating mb-3">
                    <input type="text" id="login" name="login" class="form-control"
                           placeholder="Identifiant" required autofocus>
                    <label for="login"><i class="bi bi-person me-2"></i>Identifiant</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="Mot de passe" required>
                    <label for="password"><i class="bi bi-key me-2"></i>Mot de passe</label>
                </div>

                <button type="submit" class="btn btn-warning w-100 btn-lg fw-semibold">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="<?= url('') ?>" class="text-muted small">
                    <i class="bi bi-arrow-left me-1"></i>Retour au site public
                </a>
            </div>
        </div>
    </div>
</body>
</html>
