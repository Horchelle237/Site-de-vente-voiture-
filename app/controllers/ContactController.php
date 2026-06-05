<?php
namespace App\Controllers;

use App\Core\Controller;

/**
 * ContactController
 * Affiche le formulaire et enregistre les messages reçus.
 */
class ContactController extends Controller
{
    /**
     * GET /contact
     */
    public function index(): void
    {
        $this->view('contact/index', [
            'pageTitle' => 'Nous contacter',
            'csrf'      => $this->csrfToken(),
        ]);
    }

    /**
     * POST /contact
     * Réception du formulaire : validation puis insertion en BDD.
     */
    public function store(): void
    {
        // 1. Vérification CSRF
        if (!$this->verifyCsrf()) {
            $this->flash('danger', 'Jeton de sécurité invalide. Veuillez réessayer.');
            $this->redirect('/contact');
            return;
        }

        // 2. Récupération sécurisée des champs
        $nom       = trim($_POST['nom']       ?? '');
        $prenom    = trim($_POST['prenom']    ?? '');
        $email     = trim($_POST['email']     ?? '');
        $telephone = trim($_POST['telephone'] ?? '');
        $sujet     = trim($_POST['sujet']     ?? '');
        $message   = trim($_POST['message']   ?? '');

        // 3. Validation
        $errors = [];
        if ($nom === '' || mb_strlen($nom) > 80)        $errors[] = 'Nom invalide.';
        if ($prenom === '' || mb_strlen($prenom) > 80)  $errors[] = 'Prénom invalide.';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Adresse e-mail invalide.';
        if ($message === '' || mb_strlen($message) < 10) $errors[] = 'Message trop court (10 caractères minimum).';
        if ($telephone !== '' && !preg_match('/^[\d\s\+\-\.]{6,20}$/', $telephone)) {
            $errors[] = 'Numéro de téléphone invalide.';
        }

        if (!empty($errors)) {
            $_SESSION['old'] = $_POST;
            foreach ($errors as $err) $this->flash('danger', $err);
            $this->redirect('/contact');
            return;
        }

        // 4. Insertion via le modèle (PDO requêtes préparées)
        $contactModel = $this->model('Contact');
        $contactModel->insert([
            'nom'       => $nom,
            'prenom'    => $prenom,
            'email'     => $email,
            'telephone' => $telephone ?: null,
            'sujet'     => $sujet ?: null,
            'message'   => $message,
        ]);

        unset($_SESSION['old']);
        $this->flash('success', 'Votre message a bien été envoyé. Nous vous recontacterons rapidement.');
        $this->redirect('/contact');
    }
}
