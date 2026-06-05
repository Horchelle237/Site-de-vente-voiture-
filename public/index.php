<?php
/**
 * ============================================================
 *  EuroAuto - Front controller (point d'entrée unique)
 *  Toutes les requêtes HTTP sont routées ici via .htaccess.
 * ============================================================
 */

// 1. Configuration globale
require_once __DIR__ . '/../app/config/config.php';

// 2. Autoloader des classes (App\*)
require_once APP_PATH . '/core/autoload.php';

// 3. Helpers globaux (e(), url(), asset(), ...)
require_once APP_PATH . '/core/helpers.php';

// 4. Démarrage de session sécurisée
session_name(SESSION_NAME);
session_start([
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
    'use_strict_mode' => true,
]);

// 5. Initialisation du routeur et déclaration des routes
use App\Core\Router;

$router = new Router();

// ---------- Routes publiques ----------
$router->get('/',              'HomeController@index');
$router->get('/accueil',       'HomeController@index');

$router->get('/a-propos',      'AboutController@index');

$router->get('/vehicules',     'VehiculeController@index');
$router->get('/vehicule/{id}', 'VehiculeController@show');

$router->get('/temoignages',   'TemoignageController@index');
$router->post('/temoignages',  'TemoignageController@store');

$router->get('/contact',       'ContactController@index');
$router->post('/contact',      'ContactController@store');

// ---------- Routes admin ----------
$router->get('/admin',                  'AdminController@login');
$router->get('/admin/login',            'AdminController@login');
$router->post('/admin/login',           'AdminController@authenticate');
$router->get('/admin/logout',           'AdminController@logout');
$router->get('/admin/dashboard',        'AdminController@dashboard');

$router->get('/admin/vehicules',              'AdminController@vehicules');
$router->get('/admin/vehicule/new',           'AdminController@vehiculeForm');
$router->get('/admin/vehicule/edit/{id}',     'AdminController@vehiculeForm');
$router->post('/admin/vehicule/save',         'AdminController@vehiculeSave');
$router->get('/admin/vehicule/delete/{id}',   'AdminController@vehiculeDelete');

$router->get('/admin/messages',              'AdminController@messages');
$router->get('/admin/message/read/{id}',     'AdminController@messageRead');
$router->get('/admin/message/delete/{id}',   'AdminController@messageDelete');

$router->get('/admin/temoignages',                'AdminController@temoignages');
$router->get('/admin/temoignage/approve/{id}',    'AdminController@temoignageApprove');
$router->get('/admin/temoignage/delete/{id}',     'AdminController@temoignageDelete');

// 6. Dispatch
$router->dispatch();
