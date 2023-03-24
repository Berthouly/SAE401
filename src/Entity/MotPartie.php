<?php

namespace App\Entity;

use App\Repository\MotPartieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotPartieRepository::class)]
class MotPartie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $colonne = null;

    #[ORM\Column(length: 255)]
    private ?string $ligne = null;

    #[ORM\Column(length: 255)]
    private ?string $couleur_J1 = null;

    #[ORM\Column(length: 255)]
    private ?string $couleur_J2 = null;

    #[ORM\Column(length: 255)]
    private ?string $jeton_J1 = null;

    #[ORM\Column(length: 255)]
    private ?string $jeton_J2 = null;

    #[ORM\Column(length: 255)]
    private ?string $mot_trouve = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColonne(): ?string
    {
        return $this->colonne;
    }

    public function setColonne(string $colonne): self
    {
        $this->colonne = $colonne;

        return $this;
    }

    public function getLigne(): ?string
    {
        return $this->ligne;
    }

    public function setLigne(string $ligne): self
    {
        $this->ligne = $ligne;

        return $this;
    }

    public function getCouleurJ1(): ?string
    {
        return $this->couleur_J1;
    }

    public function setCouleurJ1(string $couleur_J1): self
    {
        $this->couleur_J1 = $couleur_J1;

        return $this;
    }

    public function getCouleurJ2(): ?string
    {
        return $this->couleur_J2;
    }

    public function setCouleurJ2(string $couleur_J2): self
    {
        $this->couleur_J2 = $couleur_J2;

        return $this;
    }

    public function getJetonJ1(): ?string
    {
        return $this->jeton_J1;
    }

    public function setJetonJ1(string $jeton_J1): self
    {
        $this->jeton_J1 = $jeton_J1;

        return $this;
    }

    public function getJetonJ2(): ?string
    {
        return $this->jeton_J2;
    }

    public function setJetonJ2(string $jeton_J2): self
    {
        $this->jeton_J2 = $jeton_J2;

        return $this;
    }

    public function getMotTrouve(): ?string
    {
        return $this->mot_trouve;
    }

    public function setMotTrouve(string $mot_trouve): self
    {
        $this->mot_trouve = $mot_trouve;

        return $this;
    }
}
