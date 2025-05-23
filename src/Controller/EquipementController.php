<?php

namespace App\Controller;

use App\Entity\Equipement;
use App\Form\EquipementType;
use App\Repository\EquipementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ImagesUploader;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
// C'est ce qui permet d'utiliser les variables de SESSIONS

#[Route('/equipement')]
class EquipementController extends AbstractController
{
    #[Route('/', name: 'app_equipement_index', methods: ['GET'])]
    public function index(EquipementRepository $equipementRepository, SessionInterface $session): Response
    {
        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');

        return $this->render('equipement/index.html.twig', [
            'equipements' => $equipementRepository->findAll(),
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }


    #[Route('/new', name: 'app_equipement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ImagesUploader $uploader, SessionInterface $session): Response
    {
        $equipement = new Equipement();
        $form = $this->createForm(EquipementType::class, $equipement);
        $form->handleRequest($request);

        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');


        if ($form->isSubmitted() && $form->isValid()) {
            try {
                //on veut uploader les images
                $image = $form->get('image')->getData();
                if ($image) {
                    $uploaded = $uploader->upload($image);
                    $equipement->setImage($uploaded);
                }

                //fin upload

                $entityManager->persist($equipement);
                $entityManager->flush();

                return $this->render('equipement/new.html.twig', [
                    'equipement' => $equipement,
                    'form' => $form,
                    'success' => true,
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            } catch (\Doctrine\ORM\OptimisticLockException $oe) {
                // Gestion spécifique pour les OptimisticLockException
                // Vous pouvez ajouter ici votre logique pour gérer ces exceptions
                return $this->render('equipement/new.html.twig', [
                    'equipement' => $equipement,
                    'form' => $form,
                    'error' => 'Une erreur optimiste de verrouillage a eu lieu.',
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            } catch (\Exception $e) {
                // Pour capturer d'autres types d'exceptions
                return $this->render('equipement/new.html.twig', [
                    'equipement' => $equipement,
                    'form' => $form,
                    'error' => 'Une erreur inattendue est survenue.',
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            }

            return $this->redirectToRoute('app_equipement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('equipement/new.html.twig', [
            'equipement' => $equipement,
            'form' => $form,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}', name: 'app_equipement_show', methods: ['GET'])]
    public function show(Equipement $equipement, SessionInterface $session): Response
    {
        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');
        return $this->render('equipement/show.html.twig', [
            'equipement' => $equipement,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_equipement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Equipement $equipement, EntityManagerInterface $entityManager, ImagesUploader $uploader, SessionInterface $session): Response
    {
        $form = $this->createForm(EquipementType::class, $equipement);
        $form->handleRequest($request);

        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                //on veut uploader les images
                $image = $form->get('image')->getData();
                if ($image) {
                    $uploaded = $uploader->upload($image);
                    $equipement->setImage($uploaded);
                }

                //fin upload

                $entityManager->flush();

                // Ajoutez le paramètre 'success' pour indiquer la réussite de la mise à jour
                return $this->render('equipement/edit.html.twig', [
                    'equipement' => $equipement,
                    'form' => $form,
                    'editSuccess' => true, // Indique que la mise à jour a été réussie
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            } catch (\Exception $e) {
                // En cas d'échec de la mise à jour, afficher un message d'erreur
                // Ajoutez le paramètre 'error' pour indiquer l'échec de la mise à jour
                return $this->render('equipement/edit.html.twig', [
                    'equipement' => $equipement,
                    'form' => $form,
                    'editError' => true, // Indique que la mise à jour a échoué
                    'nom_prenom_user' => $nomPrenomUser,
                ]);
            }
            return $this->redirectToRoute('app_equipement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('equipement/edit.html.twig', [
            'equipement' => $equipement,
            'form' => $form,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}', name: 'app_equipement_delete', methods: ['POST'])]
    public function delete(Request $request, Equipement $equipement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $equipement->getId(), $request->getPayload()->get('_token'))) {
            try {
                $entityManager->remove($equipement);
                $entityManager->flush();

                // Ajoutez le paramètre 'deleteSuccess' pour indiquer la réussite de la suppression
                return $this->redirectToRoute('app_equipement_index', ['deleteSuccess' => true], Response::HTTP_SEE_OTHER);
            } catch (\Exception $e) {
                // En cas d'échec de la suppression, afficher un message d'erreur
                // Ajoutez le paramètre 'deleteError' pour indiquer l'échec de la suppression
                return $this->redirectToRoute('app_equipement_index', ['deleteError' => true], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->redirectToRoute('app_equipement_index', [], Response::HTTP_SEE_OTHER);
    }
}
