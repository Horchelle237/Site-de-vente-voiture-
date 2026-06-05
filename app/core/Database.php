<?php
namespace App\Core;

use PDO;
use PDOException;

/**
 * Classe Database
 * ---------------
 * Singleton encapsulant la connexion PDO à MySQL.
 * - Utilise des requêtes préparées pour éviter les injections SQL.
 * - Active le mode exception pour faciliter le debug.
 * - Encodage utf8mb4 pour gérer correctement les caractères spéciaux.
 */
class Database
{
    private static ?PDO $instance = null;

    /**
     * Empêche l'instanciation directe (singleton).
     */
    private function __construct() {}

    /**
     * Retourne l'instance unique de PDO.
     *
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $config = require APP_PATH . '/config/database.php';
            $dsn = sprintf(
                '%s:host=%s;port=%d;dbname=%s;charset=%s',
                $config['driver'],
                $config['host'],
                $config['port'],
                $config['database'],
                $config['charset']
            );

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_EMULATE_PREPARES   => false, // vraies requêtes préparées
            ];

            try {
                self::$instance = new PDO(
                    $dsn,
                    $config['username'],
                    $config['password'],
                    $options
                );
            } catch (PDOException $e) {
                if (APP_ENV === 'dev') {
                    die('Erreur de connexion BDD : ' . $e->getMessage());
                }
                die('Service indisponible. Veuillez réessayer plus tard.');
            }
        }

        return self::$instance;
    }
}
