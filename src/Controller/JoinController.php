<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Partie;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class JoinController extends AbstractController
{
    #[Route('/join/{id}/{joueur}', name: 'app_join')]
    public function index($id, $joueur, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        // je recupère l'utilisateur connecté
        $user = $this->getUser();
        $userID = $user->getId();
        $username = $user->getName();

        // je l'ajoute à la partie
        $partie = $doctrine->getRepository(Partie::class)->find($id);
        $save = $partie->getSavefile();
        $save[25]['j2'] = $username;

        // je sauvegarde la partie
        $partie->setSavefile($save);

        // je sauvegarde le joueur
        $partie->setJ2($userID);
        $partie->setJoueur2($username);

        // je persist
        $entityManager->persist($partie);
        $entityManager->flush();

        $save = json_encode($save, true);


        $request = new Request();
        $request->request->set('thisjoueur', 'valeur1');
        $url = "http://mmi21g01.sae401.ovh/jeu/?param1=$id&param2=$joueur";

        return new RedirectResponse($url, 302, ['target' => '_blank']);

    }
}
