<?php

namespace App\Controller;

use App\Entity\JsonPartie;
use App\Form\JsonPartieType;
use App\Repository\JsonPartieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/json/partie')]
class JsonPartieController extends AbstractController
{
    #[Route('/', name: 'app_json_partie_index', methods: ['GET'])]
    public function index(JsonPartieRepository $jsonPartieRepository): Response
    {
        return $this->render('json_partie/index.html.twig', [
            'json_parties' => $jsonPartieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_json_partie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, JsonPartieRepository $jsonPartieRepository): Response
    {
        $jsonPartie = new JsonPartie();
        $form = $this->createForm(JsonPartieType::class, $jsonPartie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jsonPartieRepository->save($jsonPartie, true);

            return $this->redirectToRoute('app_json_partie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('json_partie/new.html.twig', [
            'json_partie' => $jsonPartie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_json_partie_show', methods: ['GET'])]
    public function show(JsonPartie $jsonPartie): Response
    {
        return $this->render('json_partie/show.html.twig', [
            'json_partie' => $jsonPartie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_json_partie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, JsonPartie $jsonPartie, JsonPartieRepository $jsonPartieRepository): Response
    {
        $form = $this->createForm(JsonPartieType::class, $jsonPartie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jsonPartieRepository->save($jsonPartie, true);

            return $this->redirectToRoute('app_json_partie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('json_partie/edit.html.twig', [
            'json_partie' => $jsonPartie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_json_partie_delete', methods: ['POST'])]
    public function delete(Request $request, JsonPartie $jsonPartie, JsonPartieRepository $jsonPartieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jsonPartie->getId(), $request->request->get('_token'))) {
            $jsonPartieRepository->remove($jsonPartie, true);
        }

        return $this->redirectToRoute('app_json_partie_index', [], Response::HTTP_SEE_OTHER);
    }
}
