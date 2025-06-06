<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Entity\Creer;
use App\Form\QuizType;
use App\Repository\QuizRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Security;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
// C'est ce qui permet d'utiliser les variables de SESSIONS
#[Route('/quiz')]
class QuizController extends AbstractController
{
    #[Route('/', name: 'app_quiz_index', methods: ['GET'])]
    public function index(QuizRepository $quizRepository, SessionInterface $session): Response
    {
                // Récupérez la variable de session
                $nomPrenomUser = $session->get('nom_prenom_user');

        return $this->render('quiz/index.html.twig', [
            'quizzes' => $quizRepository->findAll(),
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/new', name: 'app_quiz_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response {
        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');
    
        // Créez un nouvel objet Quiz
        $quiz = new Quiz();
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quiz);
            $entityManager->flush();
    
            // Utilisez getUser() pour récupérer l'utilisateur actuellement connecté
            $user = $this->getUser();
    
            // Créez un nouvel objet Creer
            $creer = new Creer();
            $creer->setDateCreation(new \DateTime());
            $creer->setUser($user);
            $creer->setQuiz($quiz);
    
            // Persistez l'objet Creer
            $entityManager->persist($creer);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('quiz/new.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView(),
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }
    


    #[Route('/{id}', name: 'app_quiz_show', methods: ['GET'])]
    public function show(Quiz $quiz, SessionInterface $session): Response
    {
                // Récupérez la variable de session
                $nomPrenomUser = $session->get('nom_prenom_user');
        return $this->render('quiz/show.html.twig', [
            'quiz' => $quiz,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_quiz_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Quiz $quiz, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
                // Récupérez la variable de session
                $nomPrenomUser = $session->get('nom_prenom_user');
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quiz/edit.html.twig', [
            'quiz' => $quiz,
            'form' => $form,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}', name: 'app_quiz_delete', methods: ['POST'])]
    public function delete(Request $request, Quiz $quiz, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quiz->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($quiz);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
    }
}
