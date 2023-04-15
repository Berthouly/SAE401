<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Partie;


class MesPartiesController extends AbstractController
{
    #[Route('/{_locale}/mes/parties', name: 'app_mes_parties',requirements: ['_locale' => 'fr|en'], methods: ['GET'])]
    public function index(EntityManagerInterface $em, ManagerRegistry $doctrine, Request $request): Response
    {
        //get user
        $user = $this->getUser();
        $userid = $user->getId();
        $username = $user->getName();

        //get la locale
        $locale = $request->getLocale();

        //get all parties créées
        $partiescrees = $doctrine->getRepository(Partie::class)->findBy(['j1' => $userid]);

        //get all parties rejointes
        $partiesrejointes = $doctrine->getRepository(Partie::class)->findBy(['j2' => $userid]);

        //get all parties à rejoindre
        $partiesdispo = $doctrine->getRepository(Partie::class)->findDispo($username);



        return $this->render('mes_parties/index.html.twig', [
            'partiescrees' => $partiescrees,
            'partiesrejointes' => $partiesrejointes,
            'partiesdispo' => $partiesdispo,
            'user' => $user,
            'locale' => $locale
        ]);
    }
}
