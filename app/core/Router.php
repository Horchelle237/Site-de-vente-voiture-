<?php
namespace App\Core;

/**
 * Classe Router
 * -------------
 * Routeur simple : associe une URL à un contrôleur et une méthode.
 *
 * Les URLs sont de la forme :
 *   /                       -> HomeController@index
 *   /vehicules              -> VehiculeController@index
 *   /vehicule/5             -> VehiculeController@show (id=5)
 *   /admin/login            -> AdminController@login
 *
 * Le routage utilise $_GET['url'] alimenté par .htaccess (mod_rewrite).
 */
class Router
{
    /** Liste des routes : ['method' => ['pattern' => 'Controller@action']] */
    private array $routes = [
        'GET'  => [],
        'POST' => [],
    ];

    /**
     * Enregistre une route GET.
     */
    public function get(string $pattern, string $action): void
    {
        $this->routes['GET'][$pattern] = $action;
    }

    /**
     * Enregistre une route POST.
     */
    public function post(string $pattern, string $action): void
    {
        $this->routes['POST'][$pattern] = $action;
    }

    /**
     * Dispatche la requête courante vers le bon contrôleur.
     */
    public function dispatch(): void
    {
        $url    = $_GET['url'] ?? '';
        $url    = '/' . trim($url, '/');
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        foreach ($this->routes[$method] ?? [] as $pattern => $action) {
            // Conversion {id} -> capture (\d+)
            $regex = preg_replace('#\{[a-zA-Z_]+\}#', '(\d+)', $pattern);
            $regex = '#^' . $regex . '$#';

            if (preg_match($regex, $url, $matches)) {
                array_shift($matches); // retire le match complet
                [$controllerName, $methodName] = explode('@', $action);
                $controllerClass = "App\\Controllers\\{$controllerName}";

                if (!class_exists($controllerClass)) {
                    $this->notFound("Contrôleur {$controllerClass} introuvable");
                    return;
                }
                $controller = new $controllerClass();
                if (!method_exists($controller, $methodName)) {
                    $this->notFound("Méthode {$methodName} introuvable");
                    return;
                }
                call_user_func_array([$controller, $methodName], $matches);
                return;
            }
        }

        $this->notFound();
    }

    /**
     * Affiche une erreur 404.
     */
    private function notFound(string $debug = ''): void
    {
        http_response_code(404);
        require VIEWS_PATH . '/layouts/header.php';
        echo '<section class="container py-5 text-center">';
        echo '<h1 class="display-3 fw-bold text-warning">404</h1>';
        echo '<p class="lead">La page demandée est introuvable.</p>';
        if (APP_ENV === 'dev' && $debug !== '') {
            echo '<p class="text-muted small">Debug : ' . htmlspecialchars($debug) . '</p>';
        }
        echo '<a href="' . BASE_URL . '/" class="btn btn-warning mt-3">Retour à l\'accueil</a>';
        echo '</section>';
        require VIEWS_PATH . '/layouts/footer.php';
    }
}
