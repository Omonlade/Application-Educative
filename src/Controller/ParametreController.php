<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ParametreController extends AbstractController
{
    #[Route('/profil', name: 'app_profil', methods: ['GET', 'POST'])]
    public function index(SessionInterface $session, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, Request $request): Response
    {
        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException();
        }

        if ($request->isMethod('POST')) 
        {
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $email = $request->request->get('email');
            $plaintextPassword = $request->request->get('password');

            try 
            {
                $user->setNom($nom);
                $user->setPrenom($prenom);
                $user->setEmail($email);

                if (!empty($plaintextPassword)) {
                    $hashedPassword = $passwordHasher->hashPassword($user, $plaintextPassword);
                    $user->setPassword($hashedPassword);
                }

                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Profil mis à jour avec succès.');

            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de la mise à jour du profil.');
            }

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('parametre/index.html.twig', [
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }
}
