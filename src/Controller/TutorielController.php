<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Tutoriel;
use App\Form\TutorielType;
use App\Repository\TutorielRepository;
use App\Service\VideosUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
// C'est ce qui permet d'utiliser les variables de SESSIONS
#[Route('/tutoriel')]
class TutorielController extends AbstractController
{
    #[Route('/', name: 'app_tutoriel_index', methods: ['GET'])]
    public function index(TutorielRepository $tutorielRepository, SessionInterface $session): Response
    {
        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');
        return $this->render('tutoriel/index.html.twig', [
            'tutoriels' => $tutorielRepository->findAll(),
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/new', name: 'app_tutoriel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, VideosUploader $uploader, SessionInterface $session): Response
    {
        $tutoriel = new Tutoriel();
        $form = $this->createForm(TutorielType::class, $tutoriel);
        $form->handleRequest($request);

        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                //on veut uploader les images
                $video = $form->get('video')->getData();
                if ($video) {
                    $uploaded = $uploader->upload($video);
                    $tutoriel->setVideo($uploaded);
                }

                //fin upload

                $entityManager->persist($tutoriel);
                $entityManager->flush();

                return $this->render('tutoriel/new.html.twig', [
                    'tutoriel' => $tutoriel,
                    'form' => $form,
                    'success' => true,
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            } catch (\Doctrine\ORM\OptimisticLockException $oe) {
                // Gestion spécifique pour les OptimisticLockException
                // Vous pouvez ajouter ici votre logique pour gérer ces exceptions
                return $this->render('tutoriel/new.html.twig', [
                    'tutoriel' => $tutoriel,
                    'form' => $form,
                    'error' => 'Une erreur optimiste de verrouillage a eu lieu.',
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            } catch (\Exception $e) {
                // Pour capturer d'autres types d'exceptions
                return $this->render('tutoriel/new.html.twig', [
                    'tutoriel' => $tutoriel,
                    'form' => $form,
                    'error' => 'Une erreur inattendue est survenue.',
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            }

            return $this->redirectToRoute('app_equipement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tutoriel/new.html.twig', [
            'tutoriel' => $tutoriel,
            'form' => $form,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}', name: 'app_tutoriel_show', methods: ['GET'])]
    public function show(Tutoriel $tutoriel, SessionInterface $session): Response
    {
        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');

        return $this->render('tutoriel/show.html.twig', [
            'tutoriel' => $tutoriel,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tutoriel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tutoriel $tutoriel, EntityManagerInterface $entityManager, VideosUploader $uploader, SessionInterface $session): Response
    {
        $form = $this->createForm(TutorielType::class, $tutoriel);
        $form->handleRequest($request);

        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                //on veut uploader les images
                $video = $form->get('video')->getData();
                if ($video) {
                    $uploaded = $uploader->upload($video);
                    $tutoriel->setVideo($uploaded);
                }

                //fin upload

                $entityManager->flush();

                // Ajoutez le paramètre 'success' pour indiquer la réussite de la mise à jour
                return $this->render('tutoriel/edit.html.twig', [
                    'tutoriel' => $tutoriel,
                    'form' => $form,
                    'editSuccess' => true, // Indique que la mise à jour a été réussie
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            } catch (\Exception $e) {
                // En cas d'échec de la mise à jour, afficher un message d'erreur
                // Ajoutez le paramètre 'error' pour indiquer l'échec de la mise à jour
                return $this->render('tutoriel/edit.html.twig', [
                    'tutoriel' => $tutoriel,
                    'form' => $form,
                    'editError' => true, // Indique que la mise à jour a échoué
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            }
            return $this->redirectToRoute('app_tutoriel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tutoriel/edit.html.twig', [
            'tutoriel' => $tutoriel,
            'form' => $form,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    

    #[Route('/{id}', name: 'app_tutoriel_delete', methods: ['POST'])]
    public function delete(Request $request, Tutoriel $tutoriel, EntityManagerInterface $entityManager): Response
    {

        if ($this->isCsrfTokenValid('delete'.$tutoriel->getId(), $request->getPayload()->get('_token')))
        {
            // Récupération de l'entité Tutoriel depuis la requête
            $tutoriel = $entityManager->getRepository(Tutoriel::class)->find($tutoriel->getId());

            if (!$tutoriel) {
                throw $this->createNotFoundException('No tutoriel found for id '.$tutoriel->getId());
            }

            // Si le Tutoriel est associé à un Projet, déconnecter le Tutoriel du Projet avant de le supprimer
            if ($tutoriel->getProjet()) {
                $tutoriel->setProjet(null);
            }

            $entityManager->remove($tutoriel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tutoriel_index', [], Response::HTTP_SEE_OTHER);
    }

    
     
    
    
    
    
    
}
