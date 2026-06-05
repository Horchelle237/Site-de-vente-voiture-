<?php
namespace App\Models;

use App\Core\Model;

/**
 * Modèle Admin
 * Gestion des comptes administrateurs.
 */
class Admin extends Model
{
    protected string $table = 'admins';

    /**
     * Trouve un admin par son login.
     */
    public function findByLogin(string $login): ?object
    {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE login = :login LIMIT 1");
        $stmt->execute(['login' => $login]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }

    /**
     * Met à jour la date de dernière connexion.
     */
    public function touchLogin(int $id): void
    {
        $stmt = $this->db->prepare(
            "UPDATE admins SET derniere_connexion = NOW() WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
    }
}
