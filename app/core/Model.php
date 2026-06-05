<?php
namespace App\Core;

use PDO;

/**
 * Classe Model abstraite
 * ----------------------
 * Toutes les classes-modèle (Vehicule, Contact, Temoignage…) héritent de Model.
 * Elle expose une instance PDO et des helpers pour les opérations CRUD courantes.
 */
abstract class Model
{
    protected PDO $db;

    /** Nom de la table (à redéfinir dans la classe enfant) */
    protected string $table = '';

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Récupère toutes les lignes de la table.
     */
    public function all(string $orderBy = 'id', string $direction = 'DESC'): array
    {
        $direction = strtoupper($direction) === 'ASC' ? 'ASC' : 'DESC';
        $sql = "SELECT * FROM {$this->table} ORDER BY {$orderBy} {$direction}";
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Trouve une ligne par sa clé primaire.
     */
    public function find(int $id): ?object
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }

    /**
     * Insère une ligne et retourne l'ID inséré.
     */
    public function insert(array $data): int
    {
        $columns = array_keys($data);
        $colList = implode(', ', $columns);
        $placeholders = ':' . implode(', :', $columns);
        $sql = "INSERT INTO {$this->table} ({$colList}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        return (int) $this->db->lastInsertId();
    }

    /**
     * Met à jour une ligne par son id.
     */
    public function update(int $id, array $data): bool
    {
        $sets = [];
        foreach (array_keys($data) as $col) {
            $sets[] = "{$col} = :{$col}";
        }
        $setClause = implode(', ', $sets);
        $sql = "UPDATE {$this->table} SET {$setClause} WHERE id = :id";
        $data['id'] = $id;
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    /**
     * Supprime une ligne par son id.
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Compte le nombre total de lignes.
     */
    public function count(string $where = '1=1', array $params = []): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS nb FROM {$this->table} WHERE {$where}");
        $stmt->execute($params);
        return (int) $stmt->fetch()->nb;
    }
}
