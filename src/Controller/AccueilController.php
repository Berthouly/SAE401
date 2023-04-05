<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil', methods: ['GET'])]
    public function index(): Response
    {
        $user = $this->getUser(); // Obtenez l'utilisateur courant


        return $this->render('accueil/index.html.twig', [
            'user' => $user,
            'controller_name' => 'AccueilController',
        ]);
    }
}
