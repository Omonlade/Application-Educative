<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ImagesUploader;


use Symfony\Component\HttpFoundation\Session\SessionInterface;
// C'est ce qui permet d'utiliser les variables de SESSIONS

#[Route('/projet')]
class ProjetController extends AbstractController
{
    #[Route('/', name: 'app_projet_index', methods: ['GET'])]
    public function index(ProjetRepository $projetRepository,SessionInterface $session): Response
    {
                // Récupérez la variable de session
                $nomPrenomUser = $session->get('nom_prenom_user');

        return $this->render('projet/index.html.twig', [
            'projets' => $projetRepository->findAll(),
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/new', name: 'app_projet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,ImagesUploader $uploader,SessionInterface $session): Response
    {
                // Récupérez la variable de session
                $nomPrenomUser = $session->get('nom_prenom_user');
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                //on veut uploader les images
                $image = $form->get('image')->getData();
                if ($image) {
                    $uploaded = $uploader->upload($image);
                    $projet->setImage($uploaded);
                }

                //fin upload

                $entityManager->persist($projet);
                $entityManager->flush();

                return $this->render('projet/new.html.twig', [
                    'projet' => $projet,
                    'form' => $form,
                    'success' => true,
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            } catch (\Doctrine\ORM\OptimisticLockException $oe) {
                // Gestion spécifique pour les OptimisticLockException
                // Vous pouvez ajouter ici votre logique pour gérer ces exceptions
                return $this->render('projet/new.html.twig', [
                    'projet' => $projet,
                    'form' => $form,
                    'error' => 'Une erreur optimiste de verrouillage a eu lieu.',
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            } catch (\Exception $e) {
                // Pour capturer d'autres types d'exceptions
                return $this->render('projet/new.html.twig', [
                    'projet' => $projet,
                    'form' => $form,
                    'error' => 'Une erreur inattendue est survenue.',
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            }

            return $this->redirectToRoute('app_projet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('projet/new.html.twig', [
            'projet' => $projet,
            'form' => $form,
            'nom_prenom_user' => $nomPrenomUser,

        ]);
    }

    #[Route('/{id}', name: 'app_projet_show', methods: ['GET'])]
    public function show(Projet $projet, SessionInterface $session): Response
    {
                // Récupérez la variable de session
                $nomPrenomUser = $session->get('nom_prenom_user');
        return $this->render('projet/show.html.twig', [
            'projet' => $projet,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_projet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Projet $projet, EntityManagerInterface $entityManager,ImagesUploader $uploader, SessionInterface $session): Response
    {
                // Récupérez la variable de session
                $nomPrenomUser = $session->get('nom_prenom_user');
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                //on veut uploader les images
                $image = $form->get('image')->getData();
                if ($image) {
                    $uploaded = $uploader->upload($image);
                    $projet->setImage($uploaded);
                }

                //fin upload

                $entityManager->flush();

                // Ajoutez le paramètre 'success' pour indiquer la réussite de la mise à jour
                return $this->render('projet/edit.html.twig', [
                    'projet' => $projet,
                    'form' => $form,
                    'editSuccess' => true, // Indique que la mise à jour a été réussie
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            } catch (\Exception $e) {
                // En cas d'échec de la mise à jour, afficher un message d'erreur
                // Ajoutez le paramètre 'error' pour indiquer l'échec de la mise à jour
                return $this->render('projet/edit.html.twig', [
                    'projet' => $projet,
                    'form' => $form,
                    'editError' => true, // Indique que la mise à jour a échoué
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            }
            return $this->redirectToRoute('app_projet_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('projet/edit.html.twig', [
            'projet' => $projet,
            'form' => $form,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}', name: 'app_projet_delete', methods: ['POST'])]
    public function delete(Request $request, Projet $projet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projet->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($projet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_projet_index', [], Response::HTTP_SEE_OTHER);
    }
}
