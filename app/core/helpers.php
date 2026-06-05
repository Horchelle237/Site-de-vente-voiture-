<?php
/**
 * Fonctions utilitaires globales.
 * Inclus automatiquement par public/index.php.
 */

if (!function_exists('e')) {
    /**
     * Échappe une chaîne pour affichage HTML (anti-XSS).
     */
    function e(?string $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!function_exists('asset')) {
    /**
     * Construit une URL vers un asset (CSS, JS, image).
     */
    function asset(string $path): string
    {
        return BASE_URL . '/assets/' . ltrim($path, '/');
    }
}

if (!function_exists('url')) {
    /**
     * Construit une URL interne.
     */
    function url(string $path = ''): string
    {
        return BASE_URL . '/' . ltrim($path, '/');
    }
}

if (!function_exists('old')) {
    /**
     * Récupère la valeur précédente d'un champ (formulaires).
     */
    function old(string $key, string $default = ''): string
    {
        return isset($_SESSION['old'][$key]) ? e($_SESSION['old'][$key]) : e($default);
    }
}

if (!function_exists('flash_messages')) {
    /**
     * Affiche les messages flash et les vide.
     */
    function flash_messages(): string
    {
        if (empty($_SESSION['flash'])) {
            return '';
        }
        $html = '';
        foreach ($_SESSION['flash'] as $msg) {
            $type  = e($msg['type']);
            $text  = e($msg['message']);
            $html .= "<div class='alert alert-{$type} alert-dismissible fade show' role='alert'>"
                  . "{$text}"
                  . "<button type='button' class='btn-close' data-bs-dismiss='alert'></button>"
                  . "</div>";
        }
        unset($_SESSION['flash']);
        return $html;
    }
}

if (!function_exists('format_price')) {
    /**
     * Formate un prix en euros (français).
     */
    function format_price(float $price): string
    {
        return number_format($price, 0, ',', ' ') . ' €';
    }
}

if (!function_exists('format_km')) {
    /**
     * Formate un kilométrage.
     */
    function format_km(int $km): string
    {
        return number_format($km, 0, ',', ' ') . ' km';
    }
}

if (!function_exists('is_admin_logged')) {
    /**
     * Vérifie si l'admin est connecté.
     */
    function is_admin_logged(): bool
    {
        return !empty($_SESSION['admin_id']);
    }
}

if (!function_exists('require_admin')) {
    /**
     * Force l'authentification admin (redirige sinon).
     */
    function require_admin(): void
    {
        if (!is_admin_logged()) {
            header('Location: ' . url('admin/login'));
            exit;
        }
    }
}
