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
        $url = "http://127.0.0.1:5173/testrebuild/$id/" . base64_encode($joueur);

        return new RedirectResponse($url, 302, ['target' => '_blank']);

    }
}
