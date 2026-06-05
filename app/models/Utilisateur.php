<?php
namespace App\Models;

use App\Core\Model;

class Utilisateur extends Model
{
    protected string $table = 'utilisateurs';

    public function findByEmail(string $email): ?object
    {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }
}
