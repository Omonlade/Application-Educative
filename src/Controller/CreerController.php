<?php

namespace App\Controller;

use App\Entity\Creer;
use App\Form\CreerType;
use App\Repository\CreerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


use Symfony\Component\HttpFoundation\Session\SessionInterface;
// C'est ce qui permet d'utiliser les variables de SESSIONS
#[Route('/creer')]
class CreerController extends AbstractController
{
    #[Route('/', name: 'app_creer_index', methods: ['GET'])]
    public function index(CreerRepository $creerRepository, SessionInterface $session): Response
    {
        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');
        return $this->render('creer/index.html.twig', [
            'creers' => $creerRepository->findAll(),
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/new', name: 'app_creer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $creer = new Creer();
        $form = $this->createForm(CreerType::class, $creer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($creer);
            $entityManager->flush();

            return $this->redirectToRoute('app_creer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('creer/new.html.twig', [
            'creer' => $creer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_creer_show', methods: ['GET'])]
    public function show(Creer $creer): Response
    {

        return $this->render('creer/show.html.twig', [
            'creer' => $creer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_creer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Creer $creer, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');
        $form = $this->createForm(CreerType::class, $creer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_creer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('creer/edit.html.twig', [
            'creer' => $creer,
            'form' => $form,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}', name: 'app_creer_delete', methods: ['POST'])]
    public function delete(Request $request, Creer $creer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $creer->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($creer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_creer_index', [], Response::HTTP_SEE_OTHER);
    }
}
