<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
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

        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'nom_prenom_user' => $nom . ' ' . $prenom,
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
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
            $plaintextPassword = $form->get('password')->getData();

            $hashedPassword = $passwordHasher->hashPassword($user, $plaintextPassword);
            $user->setPassword($hashedPassword);

            try
            {
                $entityManager->persist($user);
                $entityManager->flush();
    
                return $this->render('user/new.html.twig', [
                    'user' => $user,
                    'form' => $form,
                    'success' => true,
                    'nom_prenom_user' => $nom . ' ' . $prenom,

                ]);
            } 
            catch (\Doctrine\ORM\OptimisticLockException $oe) 
            {
                // Gestion spécifique pour les OptimisticLockException
                // Vous pouvez ajouter ici votre logique pour gérer ces exceptions
                return $this->render('user/new.html.twig', [
                    'user' => $user,
                    'form' => $form,
                    'error' => 'Une erreur optimiste de verrouillage a eu lieu.',
                    'nom_prenom_user' => $nom . ' ' . $prenom,
                ]);
            } catch (\Exception $e) {
                // Pour capturer d'autres types d'exceptions
                return $this->render('user/new.html.twig', [
                    'user' => $user,
                    'form' => $form,
                    'error' => 'Une erreur inattendue est survenue.',
                    'nom_prenom_user' => $nom . ' ' . $prenom,
                ]);
            }
        }
    
        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
            'nom_prenom_user' => $nom . ' ' . $prenom,
        ]);
    }
    

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        // Récupérez l'utilisateur connecté
        $userConnect = $this->getUser();

        // Assurez-vous que l'utilisateur est connecté
        if (!$userConnect) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page.');
        }
        
        // Récupérez le nom et le prénom de l'utilisateur connecté
        $nom = $userConnect->getNom();
        $prenom = $userConnect->getPrenom();


        return $this->render('user/show.html.twig', [
            'user' => $user,
            'nom_prenom_user' => $nom . ' ' . $prenom,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
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
                $entityManager->flush();
    
                // Ajoutez le paramètre 'success' pour indiquer la réussite de la mise à jour
                return $this->render('user/edit.html.twig', [
                    'user' => $user,
                    'form' => $form,
                    'editSuccess' => true, // Indique que la mise à jour a été réussie
                    'nom_prenom_user' => $nom . ' ' . $prenom,
                ]);
            } catch (\Exception $e) {
                // En cas d'échec de la mise à jour, afficher un message d'erreur
                // Ajoutez le paramètre 'error' pour indiquer l'échec de la mise à jour
                return $this->render('user/edit.html.twig', [
                    'user' => $user,
                    'form' => $form,
                    'editError' => true, // Indique que la mise à jour a échoué
                    'nom_prenom_user' => $nom . ' ' . $prenom,
                ]);
            }
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'nom_prenom_user' => $nom . ' ' . $prenom,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) 
        {
            try 
            {
                $entityManager->remove($user);
                $entityManager->flush();
    
                // Ajoutez le paramètre 'deleteSuccess' pour indiquer la réussite de la suppression
                return $this->redirectToRoute('app_user_index', ['deleteSuccess' => true], Response::HTTP_SEE_OTHER);
            } catch (\Exception $e) {
                // En cas d'échec de la suppression, afficher un message d'erreur
                // Ajoutez le paramètre 'deleteError' pour indiquer l'échec de la suppression
                return $this->redirectToRoute('app_user_index', ['deleteError' => true], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
