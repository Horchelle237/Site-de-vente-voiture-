<?php
namespace App\Controllers;

use App\Core\Controller;

/**
 * TemoignageController
 * Affiche les avis publiés et permet aux visiteurs d'en ajouter un.
 */
class TemoignageController extends Controller
{
    /**
     * GET /temoignages
     */
    public function index(): void
    {
        $model = $this->model('Temoignage');
        $temoignages = $model->published();

        $this->view('testimonials/index', [
            'pageTitle'   => 'Témoignages clients',
            'temoignages' => $temoignages,
            'moyenne'     => $model->averageRating(),
            'csrf'        => $this->csrfToken(),
        ]);
    }

    /**
     * POST /temoignages
     */
    public function store(): void
    {
        if (!$this->verifyCsrf()) {
            $this->flash('danger', 'Jeton CSRF invalide.');
            $this->redirect('/temoignages');
            return;
        }

        $nom     = trim($_POST['nom']     ?? '');
        $email   = trim($_POST['email']   ?? '');
        $note    = (int) ($_POST['note']  ?? 0);
        $message = trim($_POST['message'] ?? '');

        $errors = [];
        if ($nom === '' || mb_strlen($nom) > 100)             $errors[] = 'Nom invalide.';
        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email invalide.';
        }
        if ($note < 1 || $note > 5)                           $errors[] = 'La note doit être comprise entre 1 et 5.';
        if (mb_strlen($message) < 10 || mb_strlen($message) > 1000) {
            $errors[] = 'Le message doit contenir entre 10 et 1000 caractères.';
        }

        if (!empty($errors)) {
            foreach ($errors as $e) $this->flash('danger', $e);
            $this->redirect('/temoignages');
            return;
        }

        // Création éventuelle de l'utilisateur si email fourni
        $userId = null;
        if ($email !== '') {
            $userModel = $this->model('Utilisateur');
            $existing  = $userModel->findByEmail($email);
            if ($existing) {
                $userId = (int) $existing->id;
            } else {
                $parts = explode(' ', $nom, 2);
                $userId = $userModel->insert([
                    'nom'    => $parts[1] ?? $nom,
                    'prenom' => $parts[0],
                    'email'  => $email,
                ]);
            }
        }

        $this->model('Temoignage')->insert([
            'utilisateur_id' => $userId,
            'nom_affiche'    => $nom,
            'note'           => $note,
            'message'        => $message,
            'valide'         => 0, // doit être validé par l'admin
        ]);

        $this->flash('success', 'Merci pour votre avis ! Il sera publié après modération.');
        $this->redirect('/temoignages');
    }
}
