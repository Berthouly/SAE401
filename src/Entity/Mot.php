<?php

namespace App\Entity;

use App\Repository\MotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotRepository::class)]
class Mot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $mot_fr = null;

    #[ORM\Column(length: 255)]
    private ?string $mot_en = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotFr(): ?string
    {
        return $this->mot_fr;
    }

    public function setMotFr(string $mot_fr): self
    {
        $this->mot_fr = $mot_fr;

        return $this;
    }

    public function getMotEn(): ?string
    {
        return $this->mot_en;
    }

    public function setMotEn(string $mot_en): self
    {
        $this->mot_en = $mot_en;

        return $this;
    }
}
