<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/{_locale}/accueil', name: 'app_accueil',requirements: ['_loacle' => 'fr|en'], methods: ['GET'])]
    public function index(Request $request): Response
    {

        $user = $this->getUser(); // Obtenez l'utilisateur courant
        $locale = $request->getLocale();
        $request->setLocale('fr');


        return $this->render('accueil/index.html.twig', [
            'locale' => $locale,
            'user' => $user,
        ]);
    }
}
