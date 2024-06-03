<?php

namespace App\Controller;

use App\Entity\Consulter;
use App\Form\ConsulterType;
use App\Repository\ConsulterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


use Symfony\Component\HttpFoundation\Session\SessionInterface; 
// C'est ce qui permet d'utiliser les variables de SESSIONS
#[Route('/consulter')]
class ConsulterController extends AbstractController
{
    #[Route('/', name: 'app_consulter_index', methods: ['GET'])]
    public function index(ConsulterRepository $consulterRepository, SessionInterface $session): Response
    {
                        // Récupérez la variable de session
                        $nomPrenomUser = $session->get('nom_prenom_user');
        return $this->render('consulter/index.html.twig', [
            'consulters' => $consulterRepository->findAll(),
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/new', name: 'app_consulter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $consulter = new Consulter();
        $form = $this->createForm(ConsulterType::class, $consulter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($consulter);
            $entityManager->flush();

            return $this->redirectToRoute('app_consulter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('consulter/new.html.twig', [
            'consulter' => $consulter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_consulter_show', methods: ['GET'])]
    public function show(Consulter $consulter, SessionInterface $session): Response
    {

        // Récupérez la variable de session
        $nomPrenomUser = $session->get('nom_prenom_user');

        return $this->render('consulter/show.html.twig', [
            'consulter' => $consulter,
            'nom_prenom_user' => $nomPrenomUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_consulter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Consulter $consulter, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConsulterType::class, $consulter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_consulter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('consulter/edit.html.twig', [
            'consulter' => $consulter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_consulter_delete', methods: ['POST'])]
    public function delete(Request $request, Consulter $consulter, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$consulter->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($consulter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_consulter_index', [], Response::HTTP_SEE_OTHER);
    }
}
