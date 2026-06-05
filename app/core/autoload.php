<?php
/**
 * Autoloader PSR-4 minimaliste.
 * Permet de charger automatiquement les classes du namespace App\
 * sans dépendre de Composer.
 *
 * Mapping :
 *   App\Core\Router        -> app/core/Router.php
 *   App\Models\Vehicule    -> app/models/Vehicule.php
 *   App\Controllers\HomeController -> app/controllers/HomeController.php
 */
spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }

    // Retire le préfixe App\
    $relative = substr($class, strlen($prefix));

    // Sépare namespace et classe : Core\Router  ->  Core / Router
    $parts = explode('\\', $relative);
    $className = array_pop($parts);

    // Met le sous-dossier en minuscule (convention : app/core, app/models, ...)
    $subdir = strtolower(implode('/', $parts));

    $file = APP_PATH . '/' . $subdir . '/' . $className . '.php';

    if (is_file($file)) {
        require_once $file;
    }
});
