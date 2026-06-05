<?php
namespace App\Core;

/**
 * Classe Controller abstraite
 * ---------------------------
 * Tous les contrôleurs héritent de cette classe.
 * Elle fournit le rendu de vues, la redirection et la gestion CSRF.
 */
abstract class Controller
{
    /**
     * Charge un modèle (lazy loading).
     *
     * @param string $name  Nom de la classe modèle (ex. : 'Vehicule')
     */
    protected function model(string $name): object
    {
        $class = "App\\Models\\{$name}";
        return new $class();
    }

    /**
     * Affiche une vue avec son layout (header + footer).
     *
     * @param string $view  Chemin relatif depuis app/views (ex. : 'home/index')
     * @param array  $data  Variables passées à la vue
     */
    protected function view(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);

        $viewFile = VIEWS_PATH . '/' . $view . '.php';
        if (!file_exists($viewFile)) {
            http_response_code(500);
            die("Vue introuvable : {$view}");
        }

        // Layout standard (header + contenu + footer)
        $isAdmin = str_starts_with($view, 'admin/');
        if ($isAdmin && $view !== 'admin/login') {
            require VIEWS_PATH . '/admin/_header.php';
            require $viewFile;
            require VIEWS_PATH . '/admin/_footer.php';
        } elseif ($view === 'admin/login') {
            require $viewFile;
        } else {
            require VIEWS_PATH . '/layouts/header.php';
            require $viewFile;
            require VIEWS_PATH . '/layouts/footer.php';
        }
    }

    /**
     * Redirection HTTP.
     */
    protected function redirect(string $path): void
    {
        header('Location: ' . BASE_URL . $path);
        exit;
    }

    /**
     * Génère un token CSRF et le stocke en session.
     */
    protected function csrfToken(): string
    {
        if (!isset($_SESSION[CSRF_TOKEN_NAME])) {
            $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
        }
        return $_SESSION[CSRF_TOKEN_NAME];
    }

    /**
     * Vérifie le jeton CSRF reçu dans le formulaire.
     */
    protected function verifyCsrf(): bool
    {
        $sent  = $_POST[CSRF_TOKEN_NAME] ?? '';
        $valid = $_SESSION[CSRF_TOKEN_NAME] ?? '';
        return is_string($sent) && hash_equals($valid, $sent);
    }

    /**
     * Stocke un message flash (affiché une fois après redirection).
     */
    protected function flash(string $type, string $message): void
    {
        $_SESSION['flash'][] = ['type' => $type, 'message' => $message];
    }
}
