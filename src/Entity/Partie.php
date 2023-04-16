<?php

namespace App\Entity;

use App\Repository\PartieRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;


#[ORM\Entity(repositoryClass: PartieRepository::class)]
#[ApiResource()]
class Partie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $savefile = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $joueur1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $joueur2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $j1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $j2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $victoire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSavefile(): array
    {
        return $this->savefile;
    }

    public function setSavefile(array $savefile): self
    {
        $this->savefile = $savefile;

        return $this;
    }

    public function getJoueur1(): ?string
    {
        return $this->joueur1;
    }

    public function setJoueur1(?string $joueur1): self
    {
        $this->joueur1 = $joueur1;

        return $this;
    }

    public function getJoueur2(): ?string
    {
        return $this->joueur2;
    }

    public function setJoueur2(?string $joueur2): self
    {
        $this->joueur2 = $joueur2;

        return $this;
    }

    public function getJ1(): ?int
    {
        return $this->j1;
    }

    public function setJ1(?int $j1): self
    {
        $this->j1 = $j1;

        return $this;
    }

    public function getJ2(): ?int
    {
        return $this->j2;
    }

    public function setJ2(?int $j2): self
    {
        $this->j2 = $j2;

        return $this;
    }

    public function getVictoire(): ?string
    {
        return $this->victoire;
    }

    public function setVictoire(?string $victoire): self
    {
        $this->victoire = $victoire;

        return $this;
    }
}
