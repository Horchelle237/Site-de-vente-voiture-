<?php
namespace App\Models;

use App\Core\Model;

/**
 * Modèle Temoignage
 * Gère les avis et témoignages clients.
 */
class Temoignage extends Model
{
    protected string $table = 'temoignages';

    /**
     * Récupère uniquement les témoignages validés (publiés).
     */
    public function published(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM temoignages WHERE valide = 1 ORDER BY date_creation DESC"
        );
        return $stmt->fetchAll();
    }

    /**
     * Récupère les témoignages en attente de modération.
     */
    public function pending(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM temoignages WHERE valide = 0 ORDER BY date_creation DESC"
        );
        return $stmt->fetchAll();
    }

    /**
     * Approuve un témoignage.
     */
    public function approve(int $id): bool
    {
        return $this->update($id, ['valide' => 1]);
    }

    /**
     * Note moyenne des témoignages publiés.
     */
    public function averageRating(): float
    {
        $row = $this->db->query(
            "SELECT AVG(note) AS avg_note FROM temoignages WHERE valide = 1"
        )->fetch();
        return $row && $row->avg_note ? (float) $row->avg_note : 0.0;
    }
}
