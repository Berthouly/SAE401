<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class ReprendreController extends AbstractController
{
    #[Route('/reprendre/{id}/{joueur}', name: 'app_reprendre')]
    public function index($id, $joueur): Response
    {







        $request = new Request();
        $request->request->set('thisjoueur', 'valeur1');
        $url = "https://mmi21g01.sae401.ovh/jeu/?param1=$id&param2=$joueur";

        return new RedirectResponse($url, 302, ['target' => '_blank']);

    }
}
