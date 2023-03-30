<?php

namespace App\Entity;

use App\Repository\StatsPartieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatsPartieRepository::class)]
class StatsPartie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $partie_joue = null;

    #[ORM\Column]
    private ?int $nb_partie_gagne = null;

    #[ORM\ManyToOne(inversedBy: 'statsParties')]
    private ?User $joueur_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartieJoue(): ?int
    {
        return $this->partie_joue;
    }

    public function setPartieJoue(int $partie_joue): self
    {
        $this->partie_joue = $partie_joue;

        return $this;
    }

    public function getNb_PartieGagne(): ?int
    {
        return $this->nb_partie_gagne;
    }

    public function setPartieGagne(int $nb_partie_gagne): self
    {
        $this->nb_partie_gagne = $nb_partie_gagne;

        return $this;
    }

    public function getJoueurId(): ?User
    {
        return $this->joueur_id;
    }

    public function setJoueurId(?User $joueur_id): self
    {
        $this->joueur_id = $joueur_id;

        return $this;
    }
}
