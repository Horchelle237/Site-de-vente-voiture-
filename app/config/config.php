<?php
/**
 * Configuration générale de l'application EuroAuto
 * --------------------------------------------------
 * Ce fichier centralise les constantes utilisées dans tout le projet.
 */

// URL de base : adapter selon l'environnement de déploiement
// Exemple en local XAMPP : http://localhost/euro-auto/public
define('BASE_URL', 'http://localhost/euro-auto/public');

// Chemins absolus (utilisés côté serveur)
define('ROOT_PATH', dirname(__DIR__, 2));
define('APP_PATH',  ROOT_PATH . '/app');
define('VIEWS_PATH', APP_PATH . '/views');
define('UPLOAD_PATH', ROOT_PATH . '/public/assets/images/vehicles');

// Identité de l'application
define('APP_NAME',    'EuroAuto');
define('APP_TAGLINE', "L'excellence automobile à portée de main");

// Environnement : 'dev' affiche les erreurs, 'prod' les masque
define('APP_ENV', 'dev');

// Paramètres de sécurité
define('SESSION_NAME', 'EURO_AUTO_SESS');
define('CSRF_TOKEN_NAME', '_csrf');

// Affichage des erreurs selon l'environnement
if (APP_ENV === 'dev') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}

// Fuseau horaire
date_default_timezone_set('Europe/Paris');
