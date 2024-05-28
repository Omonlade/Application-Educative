<?php

namespace App\Controller;

use App\Repository\EleveRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(EleveRepository $eleveRepo): Response
    {
        // Vérifiez que l'utilisateur a le rôle admin
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // Récupérez l'utilisateur connecté
        $user = $this->getUser();

        // Assurez-vous que l'utilisateur est connecté
        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page.');
        }

        // Récupérez le nom et le prénom de l'utilisateur connecté
        $nom = $user->getNom();
        $prenom = $user->getPrenom();

        // Passez les données nécessaires au template
        return $this->render('dashboard/base.html.twig', [
            'nbrEleve' => sizeof($eleveRepo->findAll()),
            'nom_prenom_user' => $nom . ' ' . $prenom,
        ]);
    }
}
