<?php
namespace App\Controllers;

use App\Core\Controller;

/**
 * VehiculeController
 * Liste, recherche filtrée et fiche détaillée d'un véhicule.
 */
class VehiculeController extends Controller
{
    /**
     * GET /vehicules  (avec filtres en query-string)
     */
    public function index(): void
    {
        $vehiculeModel  = $this->model('Vehicule');
        $categorieModel = $this->model('Categorie');

        $filters = [
            'marque'       => $_GET['marque']       ?? '',
            'categorie_id' => $_GET['categorie_id'] ?? '',
            'carburant'    => $_GET['carburant']    ?? '',
            'prix_max'     => $_GET['prix_max']     ?? '',
        ];

        $vehicules  = $vehiculeModel->search($filters);
        $categories = $categorieModel->all('nom', 'ASC');

        $this->view('vehicules/index', [
            'pageTitle'  => 'Nos véhicules',
            'vehicules'  => $vehicules,
            'categories' => $categories,
            'filters'    => $filters,
        ]);
    }

    /**
     * GET /vehicule/{id}
     */
    public function show(int $id): void
    {
        $vehiculeModel = $this->model('Vehicule');
        $vehicule = $vehiculeModel->findWithCategory($id);

        if (!$vehicule) {
            http_response_code(404);
            $this->flash('warning', 'Ce véhicule n\'existe pas ou a été retiré.');
            $this->redirect('/vehicules');
            return;
        }

        $similaires = $vehiculeModel->search([
            'categorie_id' => $vehicule->categorie_id,
        ]);
        // Retire le véhicule courant des similaires
        $similaires = array_filter($similaires, fn($v) => $v->id !== $vehicule->id);
        $similaires = array_slice($similaires, 0, 3);

        $this->view('vehicules/show', [
            'pageTitle'  => $vehicule->marque . ' ' . $vehicule->modele,
            'vehicule'   => $vehicule,
            'similaires' => $similaires,
        ]);
    }
}
