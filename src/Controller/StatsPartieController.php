<?php

namespace App\Controller;

use App\Entity\StatsPartie;
use App\Form\StatsPartieType;
use App\Repository\StatsPartieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/stats/partie')]
class StatsPartieController extends AbstractController
{
    #[Route('/', name: 'app_stats_partie_index', methods: ['GET'])]
    public function index(StatsPartieRepository $statsPartieRepository): Response
    {

        $user = $this->getUser(); // Obtenez l'utilisateur courant


        return $this->render('stats_partie/index.html.twig', [
            'user' => $user,
            'stats_parties' => $statsPartieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_stats_partie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StatsPartieRepository $statsPartieRepository): Response
    {
        $statsPartie = new StatsPartie();
        $form = $this->createForm(StatsPartieType::class, $statsPartie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statsPartieRepository->save($statsPartie, true);

            return $this->redirectToRoute('app_stats_partie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('stats_partie/new.html.twig', [
            'stats_partie' => $statsPartie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_stats_partie_show', methods: ['GET'])]
    public function show(StatsPartie $statsPartie): Response
    {
        return $this->render('stats_partie/show.html.twig', [
            'stats_partie' => $statsPartie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_stats_partie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatsPartie $statsPartie, StatsPartieRepository $statsPartieRepository): Response
    {
        $form = $this->createForm(StatsPartieType::class, $statsPartie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statsPartieRepository->save($statsPartie, true);

            return $this->redirectToRoute('app_stats_partie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('stats_partie/edit.html.twig', [
            'stats_partie' => $statsPartie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_stats_partie_delete', methods: ['POST'])]
    public function delete(Request $request, StatsPartie $statsPartie, StatsPartieRepository $statsPartieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statsPartie->getId(), $request->request->get('_token'))) {
            $statsPartieRepository->remove($statsPartie, true);
        }

        return $this->redirectToRoute('app_stats_partie_index', [], Response::HTTP_SEE_OTHER);
    }
}
