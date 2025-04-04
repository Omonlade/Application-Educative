<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Form\EleveType;
use App\Repository\EleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; // Assurez-vous que c'est la bonne annotation importée
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
// C'est ce qui permet d'utiliser les variables de SESSIONS
#[Route('/eleve')]
class EleveController extends AbstractController
{
    #[Route('/', name: 'app_eleve_index', methods: ['GET'])]
    public function index(EleveRepository $eleveRepository, SessionInterface $session): Response
    {
        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');

        return $this->render('eleve/index.html.twig', [
            'eleves' => $eleveRepository->findAll(),
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/new', name: 'app_eleve_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher,SessionInterface $session): Response
    {
        $eleve = new Eleve();
        $form = $this->createForm(EleveType::class, $eleve);
        $form->handleRequest($request);

        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $plaintextPassword = $form->get('password')->getData();
            $hashedPassword = $passwordHasher->hashPassword($eleve, $plaintextPassword);
            $eleve->setPassword($hashedPassword);

            try {
                $entityManager->persist($eleve);
                $entityManager->flush();

                return $this->render('eleve/new.html.twig', [
                    'eleve' => $eleve,
                    'form' => $form,
                    'success' => true,
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            } catch (\Doctrine\ORM\OptimisticLockException $oe) {
                return $this->render('eleve/new.html.twig', [
                    'eleve' => $eleve,
                    'form' => $form,
                    'error' => 'Une erreur optimiste de verrouillage a eu lieu.',
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            } catch (\Exception $e) {
                return $this->render('eleve/new.html.twig', [
                    'eleve' => $eleve,
                    'form' => $form,
                    'error' => 'Une erreur inattendue est survenue.',
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            }
        }

        return $this->render('eleve/new.html.twig', [
            'eleve' => $eleve,
            'form' => $form,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}', name: 'app_eleve_show', methods: ['GET'])]
    public function show(Eleve $eleve,SessionInterface $session): Response
    {
                // Récupérez la variable de session
                $nomPrenomUser = $session->get('nom_prenom_user');

        return $this->render('eleve/show.html.twig', [
            'eleve' => $eleve,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_eleve_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Eleve $eleve, EntityManagerInterface $entityManager,SessionInterface $session): Response
    {
        $form = $this->createForm(EleveType::class, $eleve);
        $form->handleRequest($request);


        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user',);

        if ($form->isSubmitted() && $form->isValid()) {
            try
            {
                $entityManager->flush();
    
                // Ajoutez le paramètre 'success' pour indiquer la réussite de la mise à jour
                return $this->render('eleve/edit.html.twig', [
                    'eleve' => $eleve,
                    'form' => $form,
                    'editSuccess' => true, // Indique que la mise à jour a été réussie
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            } catch (\Exception $e) {
                // En cas d'échec de la mise à jour, afficher un message d'erreur
                // Ajoutez le paramètre 'error' pour indiquer l'échec de la mise à jour
                return $this->render('eleve/edit.html.twig', [
                    'eleve' => $eleve,
                    'form' => $form,
                    'editError' => true, // Indique que la mise à jour a échoué
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            }
        }

        return $this->render('eleve/edit.html.twig', [
            'eleve' => $eleve,
            'form' => $form,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}', name: 'app_eleve_delete', methods: ['POST'])]
    public function delete(Request $request, Eleve $eleve, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eleve->getId(), $request->request->get('_token'))) 
        {
            try
            {
                $entityManager->remove($eleve);
                $entityManager->flush();

                // Ajoutez le paramètre 'deleteSuccess' pour indiquer la réussite de la suppression
                return $this->redirectToRoute('app_eleve_index', ['deleteSuccess' => true], Response::HTTP_SEE_OTHER);
            } catch (\Exception $e) {
                // En cas d'échec de la suppression, afficher un message d'erreur
                // Ajoutez le paramètre 'deleteError' pour indiquer l'échec de la suppression
                return $this->redirectToRoute('app_eleve_index', ['deleteError' => true], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->redirectToRoute('app_eleve_index', [], Response::HTTP_SEE_OTHER);
    }

}
