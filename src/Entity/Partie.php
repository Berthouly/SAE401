<?php

namespace App\Entity;

use App\Repository\PartieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartieRepository::class)]
class Partie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nb_joueur = null;

    #[ORM\Column(length: 255)]
    private ?string $partie_etat = null;

    #[ORM\Column(length: 255)]
    private ?string $type_partie = null;

    #[ORM\Column(length: 255)]
    private ?string $victoire = null;

    #[ORM\Column(length: 255)]
    private ?string $defaite = null;

    #[ORM\Column(length: 255)]
    private ?string $tour_joueur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbJoueur(): ?string
    {
        return $this->nb_joueur;
    }

    public function setNbJoueur(string $nb_joueur): self
    {
        $this->nb_joueur = $nb_joueur;

        return $this;
    }

    public function getPartieEtat(): ?string
    {
        return $this->partie_etat;
    }

    public function setPartieEtat(string $partie_etat): self
    {
        $this->partie_etat = $partie_etat;

        return $this;
    }

    public function getTypePartie(): ?string
    {
        return $this->type_partie;
    }

    public function setTypePartie(string $type_partie): self
    {
        $this->type_partie = $type_partie;

        return $this;
    }

    public function getVictoire(): ?string
    {
        return $this->victoire;
    }

    public function setVictoire(string $victoire): self
    {
        $this->victoire = $victoire;

        return $this;
    }

    public function getDefaite(): ?string
    {
        return $this->defaite;
    }

    public function setDefaite(string $defaite): self
    {
        $this->defaite = $defaite;

        return $this;
    }

    public function getTourJoueur(): ?string
    {
        return $this->tour_joueur;
    }

    public function setTourJoueur(string $tour_joueur): self
    {
        $this->tour_joueur = $tour_joueur;

        return $this;
    }
}
