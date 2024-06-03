<?php

namespace App\Controller;

use App\Entity\Consulter;
use App\Repository\EleveRepository;
use App\Repository\UserRepository;
use App\Repository\CreerRepository;
use App\Repository\ConsulterRepository;
use App\Repository\EquipementRepository;
use App\Repository\JouerRepository;
use App\Repository\ProjetRepository;
use App\Repository\QuestionRepository;
use App\Repository\QuizRepository;
use App\Repository\ReponseRepository;
use App\Repository\TutorielRepository;
use App\Repository\UtiliserRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\HttpFoundation\Session\SessionInterface;
// C'est ce qui permet d'utiliser les variables de SESSIONS


class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(EleveRepository $EleveRepo, CreerRepository $CreerRepo, UserRepository $UserRepo, ConsulterRepository $ConsulterRepo, JouerRepository $JouerRepo, ProjetRepository $ProjetRepo, QuestionRepository $QuestionRepo, QuizRepository $QuizRepo, EquipementRepository $EquipementRepo, ReponseRepository $ReponseRepo, TutorielRepository $TutorielRepo, UtiliserRepository $UtiliserRepo, SessionInterface $session): Response
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


        // Stockez le nom et le prénom de l'utilisateur dans la session
        $session->set('nom_prenom_user', $nom. ' '. $prenom);

        $session->set('nbrJouer', number_format(sizeof($JouerRepo->findAll()), 0, '', ' '));
        $session->set('nbrCreer', number_format(sizeof($CreerRepo->findAll()), 0, '', ' '));
        $session->set('nbrProjet', number_format(sizeof($ProjetRepo->findAll()), 0, '', ' '));
        $session->set('nbrConsulter', number_format(sizeof($ConsulterRepo->findAll()), 0, '', ' '));
        $session->set('nbrUtiliser', number_format(sizeof($UtiliserRepo->findAll()), 0, '', ' '));
        


        $nbrEleve = number_format(sizeof($EleveRepo->findAll()), 0, '', ' ');
        $nbrEquipement = number_format(sizeof($EquipementRepo->findAll()), 0, '', ' ');
        $nbrQuestion = number_format(sizeof($QuestionRepo->findAll()), 0, '', ' ');
        $nbrReponse = number_format(sizeof($ReponseRepo->findAll()), 0, '', ' ');
        $nbrTutoriel = number_format(sizeof($TutorielRepo->findAll()), 0, '', ' ');
        $nbrUser = number_format(sizeof($UserRepo->findAll()), 0, '', ' ');
        $nbrQuiz = number_format(sizeof($QuizRepo->findAll()), 0, '', ' ');
        $nbrProjet = number_format(sizeof($ProjetRepo->findAll()), 0, '', ' ');

        $session->set('nbrUtiliser', number_format(sizeof($UtiliserRepo->findAll()), 0, '', ' '));
        $session->set('nbrEleve', $nbrEleve);
        $session->set('nbrEquipement', $nbrEquipement);
        $session->set('nbrQuestion', $nbrQuestion);
        $session->set('nbrReponse', $nbrReponse);
        $session->set('nbrTutoriel', $nbrTutoriel);
        $session->set('nbrUser', $nbrUser);
        $session->set('nbrQuiz', $nbrQuiz);
        $session->set('nbrProjet', $nbrProjet);

        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');
        

        // Passez les données nécessaires au template
        return $this->render('dashboard/base.html.twig', [
           'nom_prenom_user' => $nomPrenomUser,

           'nbrEleve' => sizeof($EleveRepo->findAll()),
           'nbrEquipement' => sizeof($EquipementRepo->findAll()),
           'nbrQuestion' => sizeof($QuestionRepo->findAll()),
           'nbrReponse' => sizeof($ReponseRepo->findAll()),
           'nbrTutoriel' => sizeof($TutorielRepo->findAll()),
           'nbrUser' => sizeof($UserRepo->findAll()),
           'nbrQuiz' => sizeof($QuizRepo->findAll()),
           'nbrProjet' => sizeof($ProjetRepo->findAll()),

           'nbrJouer' => sizeof($JouerRepo->findAll()),
           'nbrUtiliser' => sizeof($UtiliserRepo->findAll()),
           'nbrConsulter' => sizeof($ConsulterRepo->findAll()),
           'nbrCreer' => sizeof($CreerRepo->findAll()),
        ]);
    }
}
