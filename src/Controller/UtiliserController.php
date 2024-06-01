<?php

namespace App\Controller;

use App\Entity\Utiliser;
use App\Form\UtiliserType;
use App\Repository\UtiliserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
// C'est ce qui permet d'utiliser les variables de SESSIONS
#[Route('/utiliser')]
class UtiliserController extends AbstractController
{

    #[Route('/', name: 'app_utiliser_index', methods: ['GET'])]
    public function index(UtiliserRepository $utiliserRepository, SessionInterface $session): Response
    {
        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');
        return $this->render('utiliser/index.html.twig', [
            'utilisers' => $utiliserRepository->findAll(),
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/new', name: 'app_utiliser_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');
        $utiliser = new Utiliser();
        $form = $this->createForm(UtiliserType::class, $utiliser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($utiliser);
            $entityManager->flush();

            return $this->redirectToRoute('app_utiliser_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('utiliser/new.html.twig', [
            'utiliser' => $utiliser,
            'form' => $form,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}', name: 'app_utiliser_show', methods: ['GET'])]
    public function show(Utiliser $utiliser, SessionInterface $session): Response
    {
        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');
        return $this->render('utiliser/show.html.twig', [
            'utiliser' => $utiliser,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_utiliser_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Utiliser $utiliser, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');
        $form = $this->createForm(UtiliserType::class, $utiliser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_utiliser_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('utiliser/edit.html.twig', [
            'utiliser' => $utiliser,
            'form' => $form,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}', name: 'app_utiliser_delete', methods: ['POST'])]
    public function delete(Request $request, Utiliser $utiliser, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $utiliser->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($utiliser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_utiliser_index', [], Response::HTTP_SEE_OTHER);
    }
}
