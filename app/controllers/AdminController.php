<?php
namespace App\Controllers;

use App\Core\Controller;

/**
 * AdminController
 * Espace d'administration sécurisé : auth, dashboard, CRUD véhicules,
 * modération des témoignages, consultation des messages.
 */
class AdminController extends Controller
{
    // ====================================================================
    //  Authentification
    // ====================================================================

    /**
     * GET /admin/login - Affiche le formulaire de connexion.
     */
    public function login(): void
    {
        if (is_admin_logged()) {
            $this->redirect('/admin/dashboard');
            return;
        }
        $this->view('admin/login', [
            'pageTitle' => 'Connexion administrateur',
            'csrf'      => $this->csrfToken(),
        ]);
    }

    /**
     * POST /admin/login - Tentative de connexion.
     */
    public function authenticate(): void
    {
        if (!$this->verifyCsrf()) {
            $this->flash('danger', 'Jeton CSRF invalide.');
            $this->redirect('/admin/login');
            return;
        }

        $login    = trim($_POST['login']    ?? '');
        $password = (string) ($_POST['password'] ?? '');

        if ($login === '' || $password === '') {
            $this->flash('danger', 'Identifiants requis.');
            $this->redirect('/admin/login');
            return;
        }

        $admin = $this->model('Admin')->findByLogin($login);
        if (!$admin || !password_verify($password, $admin->mot_de_passe)) {
            $this->flash('danger', 'Identifiants incorrects.');
            $this->redirect('/admin/login');
            return;
        }

        // Régénération de l'ID de session (anti-fixation)
        session_regenerate_id(true);
        $_SESSION['admin_id']   = (int) $admin->id;
        $_SESSION['admin_name'] = $admin->nom_complet;
        $this->model('Admin')->touchLogin((int) $admin->id);

        $this->flash('success', 'Bienvenue ' . $admin->nom_complet . ' !');
        $this->redirect('/admin/dashboard');
    }

    /**
     * GET /admin/logout
     */
    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();
        header('Location: ' . url('admin/login'));
        exit;
    }

    // ====================================================================
    //  Dashboard
    // ====================================================================

    public function dashboard(): void
    {
        require_admin();

        $vehiculeModel   = $this->model('Vehicule');
        $contactModel    = $this->model('Contact');
        $temoignageModel = $this->model('Temoignage');

        $stats = [
            'vehicules_total'   => $vehiculeModel->count(),
            'vehicules_dispo'   => $vehiculeModel->count('disponible = 1'),
            'messages_total'    => $contactModel->count(),
            'messages_non_lus'  => $contactModel->countUnread(),
            'temoignages_total' => $temoignageModel->count(),
            'temoignages_pend'  => $temoignageModel->count('valide = 0'),
        ];

        $derniers_messages = array_slice($contactModel->all('date_envoi'), 0, 5);

        $this->view('admin/dashboard', [
            'pageTitle'         => 'Tableau de bord',
            'stats'             => $stats,
            'derniers_messages' => $derniers_messages,
        ]);
    }

    // ====================================================================
    //  CRUD véhicules
    // ====================================================================

    public function vehicules(): void
    {
        require_admin();
        $vehicules = $this->model('Vehicule')->allWithCategory();
        $this->view('admin/vehicules', [
            'pageTitle' => 'Gestion des véhicules',
            'vehicules' => $vehicules,
        ]);
    }

    public function vehiculeForm(?int $id = null): void
    {
        require_admin();
        $vehicule  = $id ? $this->model('Vehicule')->find($id) : null;
        $categories = $this->model('Categorie')->all('nom', 'ASC');

        $this->view('admin/vehicule_form', [
            'pageTitle'  => $vehicule ? 'Modifier un véhicule' : 'Ajouter un véhicule',
            'vehicule'   => $vehicule,
            'categories' => $categories,
            'csrf'       => $this->csrfToken(),
        ]);
    }

    public function vehiculeSave(): void
    {
        require_admin();
        if (!$this->verifyCsrf()) {
            $this->flash('danger', 'Jeton CSRF invalide.');
            $this->redirect('/admin/vehicules');
            return;
        }

        $id = isset($_POST['id']) && $_POST['id'] !== '' ? (int) $_POST['id'] : null;

        // Validation rapide
        $data = [
            'marque'       => trim($_POST['marque'] ?? ''),
            'modele'       => trim($_POST['modele'] ?? ''),
            'annee'        => (int) ($_POST['annee'] ?? 0),
            'prix'         => (float) ($_POST['prix'] ?? 0),
            'kilometrage'  => (int) ($_POST['kilometrage'] ?? 0),
            'carburant'    => $_POST['carburant'] ?? 'Essence',
            'boite'        => $_POST['boite'] ?? 'Manuelle',
            'puissance'    => (int) ($_POST['puissance'] ?? 0),
            'couleur'      => trim($_POST['couleur'] ?? ''),
            'description'  => trim($_POST['description'] ?? ''),
            'categorie_id' => (int) ($_POST['categorie_id'] ?? 0),
            'disponible'   => isset($_POST['disponible']) ? 1 : 0,
        ];

        if ($data['marque'] === '' || $data['modele'] === '' || $data['prix'] <= 0) {
            $this->flash('danger', 'Marque, modèle et prix obligatoires.');
            $this->redirect($id ? "/admin/vehicule/edit/{$id}" : '/admin/vehicule/new');
            return;
        }

        // Upload de l'image (optionnel en édition)
        $imageName = $_POST['image_existante'] ?? '';
        if (!empty($_FILES['image']['name'])) {
            $imageName = $this->handleImageUpload($_FILES['image']);
            if ($imageName === null) {
                $this->flash('danger', 'Image invalide (jpg, png, webp ; 4 Mo max).');
                $this->redirect($id ? "/admin/vehicule/edit/{$id}" : '/admin/vehicule/new');
                return;
            }
        }
        if ($imageName === '') {
            $imageName = 'placeholder.jpg';
        }
        $data['image'] = $imageName;

        if ($id) {
            $this->model('Vehicule')->update($id, $data);
            $this->flash('success', 'Véhicule mis à jour.');
        } else {
            $this->model('Vehicule')->insert($data);
            $this->flash('success', 'Véhicule ajouté.');
        }
        $this->redirect('/admin/vehicules');
    }

    public function vehiculeDelete(int $id): void
    {
        require_admin();
        $this->model('Vehicule')->delete($id);
        $this->flash('success', 'Véhicule supprimé.');
        $this->redirect('/admin/vehicules');
    }

    /**
     * Traitement sécurisé de l'upload d'image.
     */
    private function handleImageUpload(array $file): ?string
    {
        if ($file['error'] !== UPLOAD_ERR_OK)               return null;
        if ($file['size']  > 4 * 1024 * 1024)               return null; // 4 Mo

        $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime  = $finfo->file($file['tmp_name']);
        if (!isset($allowed[$mime])) return null;

        $newName = uniqid('veh_', true) . '.' . $allowed[$mime];
        $target  = UPLOAD_PATH . '/' . $newName;
        if (!is_dir(UPLOAD_PATH)) mkdir(UPLOAD_PATH, 0755, true);
        if (!move_uploaded_file($file['tmp_name'], $target)) return null;

        return $newName;
    }

    // ====================================================================
    //  Messages de contact
    // ====================================================================

    public function messages(): void
    {
        require_admin();
        $messages = $this->model('Contact')->all('date_envoi');
        $this->view('admin/messages', [
            'pageTitle' => 'Messages reçus',
            'messages'  => $messages,
        ]);
    }

    public function messageRead(int $id): void
    {
        require_admin();
        $this->model('Contact')->markAsRead($id);
        $this->redirect('/admin/messages');
    }

    public function messageDelete(int $id): void
    {
        require_admin();
        $this->model('Contact')->delete($id);
        $this->flash('success', 'Message supprimé.');
        $this->redirect('/admin/messages');
    }

    // ====================================================================
    //  Modération témoignages
    // ====================================================================

    public function temoignages(): void
    {
        require_admin();
        $model = $this->model('Temoignage');
        $this->view('admin/temoignages', [
            'pageTitle' => 'Modération des témoignages',
            'pending'   => $model->pending(),
            'published' => $model->published(),
        ]);
    }

    public function temoignageApprove(int $id): void
    {
        require_admin();
        $this->model('Temoignage')->approve($id);
        $this->flash('success', 'Témoignage publié.');
        $this->redirect('/admin/temoignages');
    }

    public function temoignageDelete(int $id): void
    {
        require_admin();
        $this->model('Temoignage')->delete($id);
        $this->flash('success', 'Témoignage supprimé.');
        $this->redirect('/admin/temoignages');
    }
}
