<?php

namespace App\Controller;

use App\Entity\Jouer;
use App\Form\JouerType;
use App\Repository\JouerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface; 
// C'est ce qui permet d'utiliser les variables de SESSIONS
#[Route('/jouer')]
class JouerController extends AbstractController
{
    #[Route('/', name: 'app_jouer_index', methods: ['GET'])]
    public function index(JouerRepository $jouerRepository,  SessionInterface $session): Response
    {
                // Récupérez la variable de session
                $nomPrenomUser = $session->get('nom_prenom_user');
                // Affichez la variable de session
        return $this->render('jouer/index.html.twig', [
            'jouers' => $jouerRepository->findAll(),
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/new', name: 'app_jouer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,  SessionInterface $session): Response
    {
                // Récupérez la variable de session
                $nomPrenomUser = $session->get('nom_prenom_user');
                // Affichez la variable de session
        $jouer = new Jouer();
        $form = $this->createForm(JouerType::class, $jouer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jouer);
            $entityManager->flush();

            return $this->redirectToRoute('app_jouer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jouer/new.html.twig', [
            'jouer' => $jouer,
            'form' => $form,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}', name: 'app_jouer_show', methods: ['GET'])]
    public function show(Jouer $jouer,  SessionInterface $session): Response
    {
                // Récupérez la variable de session
                $nomPrenomUser = $session->get('nom_prenom_user');

        return $this->render('jouer/show.html.twig', [
            'jouer' => $jouer,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_jouer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Jouer $jouer, EntityManagerInterface $entityManager,  SessionInterface $session): Response
    {
                // Récupérez la variable de session
                $nomPrenomUser = $session->get('nom_prenom_user');

        $form = $this->createForm(JouerType::class, $jouer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_jouer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jouer/edit.html.twig', [
            'jouer' => $jouer,
            'form' => $form,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}', name: 'app_jouer_delete', methods: ['POST'])]
    public function delete(Request $request, Jouer $jouer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jouer->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($jouer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_jouer_index', [], Response::HTTP_SEE_OTHER);
    }
}
