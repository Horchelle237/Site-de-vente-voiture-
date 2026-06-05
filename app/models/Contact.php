<?php
namespace App\Models;

use App\Core\Model;

/**
 * Modèle Contact
 * Gère les messages reçus depuis le formulaire « Nous contacter ».
 */
class Contact extends Model
{
    protected string $table = 'contacts';

    /**
     * Marque un message comme lu.
     */
    public function markAsRead(int $id): bool
    {
        return $this->update($id, ['lu' => 1]);
    }

    /**
     * Compte les messages non lus (pour le badge admin).
     */
    public function countUnread(): int
    {
        return $this->count('lu = 0');
    }
}
