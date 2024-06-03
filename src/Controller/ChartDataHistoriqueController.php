<?php 

// src/Controller/ChartDataController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ChartDataHistoriqueController extends AbstractController
{
    #[Route('/chart-data', name: 'chart_data_historique')]
    public function index(SessionInterface $session): JsonResponse
    {
        // Récupérez les variables de session
        $nbrJouer = $session->get('nbrJouer', 0);
        $nbrCreer = $session->get('nbrCreer', 0);
        $nbrProjet = $session->get('nbrProjet', 0);
        $nbrConsulter = $session->get('nbrConsulter', 0);
        $nbrUtiliser = $session->get('nbrUtiliser', 0);

        // Vérifiez si les variables sont numériques
        $nbrJouer = is_numeric($nbrJouer) ? (int)$nbrJouer : 0;
        $nbrCreer = is_numeric($nbrCreer) ? (int)$nbrCreer : 0;
        $nbrProjet = is_numeric($nbrProjet) ? (int)$nbrProjet : 0;
        $nbrConsulter = is_numeric($nbrConsulter) ? (int)$nbrConsulter : 0;
        $nbrUtiliser = is_numeric($nbrUtiliser) ? (int)$nbrUtiliser : 0;

        // Récupérez vos données depuis la base de données ou toute autre source
        $data = [
            'labels' => ['Jouer', 'Creer', 'Projet', 'Consulter', 'Utiliser'],
            'datasets' => [
                [
                    'label' => 'Historiques des Événements',
                    'data' => [$nbrJouer, $nbrCreer, $nbrProjet, $nbrConsulter, $nbrUtiliser],
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];

        return new JsonResponse($data);
    }











    #[Route('/chart-data-pie', name: 'chart_data_pie')]
    public function pieChartData(SessionInterface $session): JsonResponse
    {
        // Récupérez les variables de session
        $nbrEleve = $session->get('nbrEleve', 0);
        $nbrEquipement = $session->get('nbrEquipement', 0);
        $nbrQuestion = $session->get('nbrQuestion', 0);
        $nbrReponse = $session->get('nbrReponse', 0);
        $nbrTutoriel = $session->get('nbrTutoriel', 0);
        $nbrUser = $session->get('nbrUser', 0);
        $nbrQuiz = $session->get('nbrQuiz', 0);
        $nbrProjet = $session->get('nbrProjet', 0);

        // Convertissez les valeurs en entiers
        $nbrEleve = (int)str_replace(' ', '', $nbrEleve);
        $nbrEquipement = (int)str_replace(' ', '', $nbrEquipement);
        $nbrQuestion = (int)str_replace(' ', '', $nbrQuestion);
        $nbrReponse = (int)str_replace(' ', '', $nbrReponse);
        $nbrTutoriel = (int)str_replace(' ', '', $nbrTutoriel);
        $nbrUser = (int)str_replace(' ', '', $nbrUser);
        $nbrQuiz = (int)str_replace(' ', '', $nbrQuiz);
        $nbrProjet = (int)str_replace(' ', '', $nbrProjet);

        // Récupérez vos données depuis la base de données ou toute autre source
        $data = [
            'labels' => ['Élèves', 'Équipements', 'Questions', 'Réponses', 'Tutoriels', 'Utilisateurs', 'Quiz', 'Projets'],
            'datasets' => [
                [
                    'label' => 'Répartition des Événements',
                    'data' => [$nbrEleve, $nbrEquipement, $nbrQuestion, $nbrReponse, $nbrTutoriel, $nbrUser, $nbrQuiz, $nbrProjet],
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(199, 199, 199, 0.2)',
                        'rgba(83, 102, 255, 0.2)',
                    ],
                    'borderColor' => [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(199, 199, 199, 1)',
                        'rgba(83, 102, 255, 1)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
        ];

        return new JsonResponse($data);
    }

}
