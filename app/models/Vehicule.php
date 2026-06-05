<?php
namespace App\Models;

use App\Core\Model;

/**
 * Modèle Vehicule
 * Gère les opérations métier sur la table `vehicules`.
 */
class Vehicule extends Model
{
    protected string $table = 'vehicules';

    /**
     * Récupère tous les véhicules disponibles avec leur catégorie (jointure).
     *
     * @param int|null $limit Limite éventuelle pour le résultat
     */
    public function allWithCategory(?int $limit = null): array
    {
        $sql = "SELECT v.*, c.nom AS categorie
                FROM vehicules v
                INNER JOIN categories c ON c.id = v.categorie_id
                WHERE v.disponible = 1
                ORDER BY v.date_ajout DESC";
        if ($limit !== null) {
            $sql .= ' LIMIT ' . (int) $limit;
        }
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Trouve un véhicule par id avec le nom de sa catégorie.
     */
    public function findWithCategory(int $id): ?object
    {
        $sql = "SELECT v.*, c.nom AS categorie
                FROM vehicules v
                INNER JOIN categories c ON c.id = v.categorie_id
                WHERE v.id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }

    /**
     * Recherche filtrée multicritères (utilisée sur la page véhicules).
     */
    public function search(array $filters = []): array
    {
        $sql = "SELECT v.*, c.nom AS categorie
                FROM vehicules v
                INNER JOIN categories c ON c.id = v.categorie_id
                WHERE v.disponible = 1";
        $params = [];

        if (!empty($filters['marque'])) {
            $sql .= ' AND v.marque LIKE :marque';
            $params['marque'] = '%' . $filters['marque'] . '%';
        }
        if (!empty($filters['categorie_id'])) {
            $sql .= ' AND v.categorie_id = :cat';
            $params['cat'] = (int) $filters['categorie_id'];
        }
        if (!empty($filters['carburant'])) {
            $sql .= ' AND v.carburant = :carb';
            $params['carb'] = $filters['carburant'];
        }
        if (!empty($filters['prix_max'])) {
            $sql .= ' AND v.prix <= :prixmax';
            $params['prixmax'] = (float) $filters['prix_max'];
        }
        $sql .= ' ORDER BY v.date_ajout DESC';

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
