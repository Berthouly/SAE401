<?php

namespace App\Entity;

use App\Repository\IndiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IndiceRepository::class)]
class Indice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $nb_mots = null;

    #[ORM\Column]
    private ?int $mot_trouve_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbMots(): ?string
    {
        return $this->nb_mots;
    }

    public function setNbMots(string $nb_mots): self
    {
        $this->nb_mots = $nb_mots;

        return $this;
    }

    public function getMotTrouveId(): ?int
    {
        return $this->mot_trouve_id;
    }

    public function setMotTrouveId(int $mot_trouve_id): self
    {
        $this->mot_trouve_id = $mot_trouve_id;

        return $this;
    }
}
