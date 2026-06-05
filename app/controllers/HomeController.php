<?php
namespace App\Controllers;

use App\Core\Controller;

/**
 * HomeController
 * Page d'accueil : présente les véhicules vedettes et les chiffres clés.
 */
class HomeController extends Controller
{
    public function index(): void
    {
        $vehiculeModel   = $this->model('Vehicule');
        $temoignageModel = $this->model('Temoignage');
        $contactModel    = $this->model('Contact');

        $featured = $vehiculeModel->allWithCategory(6);

        $stats = [
            'vehicules'   => $vehiculeModel->count('disponible = 1'),
            'temoignages' => $temoignageModel->count('valide = 1'),
            'ventes'      => 248,            // valeur statique (donnée commerciale)
            'satisfaits'  => 1325,           // valeur statique
        ];

        $temoignages = $temoignageModel->published();

        $this->view('home/index', [
            'featured'    => $featured,
            'stats'       => $stats,
            'temoignages' => array_slice($temoignages, 0, 3),
            'pageTitle'   => 'Accueil',
        ]);
    }
}
