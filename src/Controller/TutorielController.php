<?php

namespace App\Controller;

use App\Entity\Tutoriel;
use App\Form\TutorielType;
use App\Repository\TutorielRepository;
use App\Service\VideosUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/tutoriel')]
class TutorielController extends AbstractController
{
    #[Route('/', name: 'app_tutoriel_index', methods: ['GET'])]
    public function index(TutorielRepository $tutorielRepository): Response
    {
                        // Récupérez l'utilisateur connecté
                        $user = $this->getUser();

                        // Assurez-vous que l'utilisateur est connecté
                        if (!$user) {
                            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page.');
                        }
        
                        // Récupérez le nom et le prénom de l'utilisateur connecté
                        $nom = $user->getNom();
                        $prenom = $user->getPrenom();

        return $this->render('tutoriel/index.html.twig', [
            'tutoriels' => $tutorielRepository->findAll(),
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/new', name: 'app_tutoriel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, VideosUploader $uploader): Response
    {
        $tutoriel = new Tutoriel();
        $form = $this->createForm(TutorielType::class, $tutoriel);
        $form->handleRequest($request);

                // Récupérez l'utilisateur connecté
                $userConnect = $this->getUser();

                // Assurez-vous que l'utilisateur est connecté
                if (!$userConnect) {
                    throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page.');
                }
                
                // Récupérez le nom et le prénom de l'utilisateur connecté
                $nom = $userConnect->getNom();
                $prenom = $userConnect->getPrenom();

        if ($form->isSubmitted() && $form->isValid()) 
        {
            try
            {
                //on veut uploader les images
                        $video = $form->get('video')->getData();
                        if($video)
                        {
                            $uploaded=$uploader->upload($video);
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
            } 
            catch (\Doctrine\ORM\OptimisticLockException $oe) 
            {
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
    public function show(Tutoriel $tutoriel): Response
    {
                // Récupérez l'utilisateur connecté
                $user = $this->getUser();

                // Assurez-vous que l'utilisateur est connecté
                if (!$user) {
                    throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page.');
                }

                // Récupérez le nom et le prénom de l'utilisateur connecté
                $nom = $user->getNom();
                $prenom = $user->getPrenom();

        return $this->render('tutoriel/show.html.twig', [
            'tutoriel' => $tutoriel,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tutoriel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tutoriel $tutoriel, EntityManagerInterface $entityManager, VideosUploader $uploader): Response
    {
        $form = $this->createForm(TutorielType::class, $tutoriel);
        $form->handleRequest($request);

                        // Récupérez l'utilisateur connecté
                        $userConnect = $this->getUser();

                        // Assurez-vous que l'utilisateur est connecté
                        if (!$userConnect) {
                            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page.');
                        }
                        
                        // Récupérez le nom et le prénom de l'utilisateur connecté
                        $nom = $userConnect->getNom();
                        $prenom = $userConnect->getPrenom();
        

        if ($form->isSubmitted() && $form->isValid())
        {
            try
            {
                        //on veut uploader les images
                                $video = $form->get('video')->getData();
                                if($image)
                                {
                                    $uploaded=$uploader->upload($video);
                                    $tutoriel->setImage($uploaded);
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
        if ($this->isCsrfTokenValid('delete'.$tutoriel->getId(), $request->getPayload()->get('_token'))) {
            try 
            {
                $entityManager->remove($tutoriel);
                $entityManager->flush();
    
                // Ajoutez le paramètre 'deleteSuccess' pour indiquer la réussite de la suppression
                return $this->redirectToRoute('app_tutoriel_index', ['deleteSuccess' => true], Response::HTTP_SEE_OTHER);
            } catch (\Exception $e) {
                // En cas d'échec de la suppression, afficher un message d'erreur
                // Ajoutez le paramètre 'deleteError' pour indiquer l'échec de la suppression
                return $this->redirectToRoute('app_tutoriel_index', ['deleteError' => true], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->redirectToRoute('app_tutoriel_index', [], Response::HTTP_SEE_OTHER);
    }
}
