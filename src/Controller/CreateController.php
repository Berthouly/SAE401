<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
// redirect reponse
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Partie;
use App\Entity\User;
use App\Repository\PartieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Form\Type\DoctrineType;


class CreateController extends AbstractController
{
    #[Route('/{_locale}/create', name: 'app_create', requirements: ['_locale' => 'fr|en'], methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, ManagerRegistry $doctrine, Request $request): Response
    {

        // je stocke le chemin vers le dossier json
        $jsonPath = $this->getParameter('kernel.project_dir') . '/public/json/'; 

        //je récupère la locale
        $locale = $request->getLocale();

        if($locale == 'fr') {
            $wordlist = file_get_contents($jsonPath.'wordslist.json');
        } else {
            $wordlist = file_get_contents($jsonPath.'wordslist_en.json');
        }

        // RECUPERATION DES MOTS
        // je récupère tout
        // je mélange
        // je prends les 25 premiers
        
        
        $wordlistArray = json_decode($wordlist, true);
        shuffle($wordlistArray);
        $wordlist25 = array_slice($wordlistArray, 0, 25);
        // var_dump($wordlist25);

        // RECUPERATION DES COULEURS J1
        // je récupère tout
        // je mélange
        $colorslistj1 = file_get_contents($jsonPath.'couleurs.json');
        $colorslistj1Array = json_decode($colorslistj1, true);
        shuffle($colorslistj1Array);
        // var_dump('<br>J1 :<br>');
        // var_dump($colorslistj1Array);


        // RECUPERATION DES COULEURS J2
        // je récupère tout
        // je mélange
        $colorslistj2 = file_get_contents($jsonPath.'couleurs.json');
        $colorslistj2Array = json_decode($colorslistj2, true);
        shuffle($colorslistj2Array);
        // var_dump('<br>J2 :<br>');
        // var_dump($colorslistj2Array);

        // Je crée un nouveau tableau qui rassemble les mots et les couleurs

        foreach($wordlist25 as $key => $value) {
            $wordlist25[$key] = array(
                'mot' => $value,
                'couleurJ1' => $colorslistj1Array[$key],
                'couleurJ2' => $colorslistj2Array[$key],
                'position' => $key
            );
        }
        // var_dump('<br>Map partie :<br>');
        // var_export($wordlist25);

        // je récupère les variables de session (joueurs, partie, etc)
        //recuperer le user connecte
        $objetuser = $this->getUser();
        $user = $objetuser->getName();
        $j1ID = $objetuser->getId();


        $j1 = $user;
        $j2 = null;
        $currentPlayer = $j1;
        $dernierIndice = ['Les indices ici', '1'];
        //je définis un nombre au hasard pour nommer la partie
        $partieID = rand(0, 1000000);

        // je rajoute les variables de session dans le tableau de la partie
        array_push($wordlist25, array(
            'partieID' => $partieID,
            'j1' => $j1,
            'j2' => $j2,
            'currentPlayer' => $currentPlayer,
            'dernierIndice' => $dernierIndice,
            'agentstrouves' => 0,
            'jetonsrestants' => 9
        ));
                

                //requete vers la bdd directement
                $entityManager = $doctrine->getManager();

                $partie = new Partie();
                $partie->setSavefile($wordlist25);
                $partie->setJoueur1($user);
                $partie->setJ1($j1ID);

                // Obtenez l'EntityManager à partir de l'injection de dépendances ou en utilisant le service locator
                

                // Ajouter l'entité à l'EntityManager
                $entityManager->persist($partie);

                // Exécuter la transaction enregistrant l'entité dans la base de données
                $entityManager->flush();

                //je recupère l'id de la nouvelle partie
                $partieID = $partie->getId();
                //je la convertis en string
                $partieID = strval($partieID);
                $joueur = 'j1';
                

                if($locale == 'fr') {
                    // $url = "http://127.0.0.1:5173/partiefr/$partieID/" . base64_encode($joueur);
                    $url = "http://127.0.0.1:5500/#/partiefr/$partieID/" . base64_encode($joueur);

                } else {
                    $url = "http://127.0.0.1:5173/partieen/$partieID/" . base64_encode($joueur);
                }


                return new RedirectResponse($url, 302, ['target' => '_blank']);
                            // return $this->render('create/index.html.twig', [
            //     'response' => $response,
            // ]);
            
    }
}
