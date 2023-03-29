<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PartieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: PartieRepository::class)]
#[ApiResource]

class Partie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne()]
    #[MaxDepth(1)]
    private ?User $joueur1 = null;

    #[ORM\ManyToOne]
    #[MaxDepth(1)]
    private ?User $joueur2 = null;

    #[ORM\Column(length: 255)]
    private ?string $etatPartie = null;

    #[ORM\ManyToOne]
    #[MaxDepth(1)]
    private ?User $tourJoueur = null;

    #[ORM\Column(length: 255)]
    private ?string $victoire = null;

    #[ORM\OneToMany(mappedBy: 'partie', targetEntity: MotPartie::class)]
    private Collection $motParties;

    public function __construct()
    {
        $this->motParties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJoueur1(): ?User
    {
        return $this->joueur1;
    }

    public function setJoueur1(?User $joueur1): self
    {
        $this->joueur1 = $joueur1;

        return $this;
    }

    public function getJoueur2(): ?User
    {
        return $this->joueur2;
    }

    public function setJoueur2(?User $joueur2): self
    {
        $this->joueur2 = $joueur2;

        return $this;
    }

    public function getEtatPartie(): ?string
    {
        return $this->etatPartie;
    }

    public function setEtatPartie(string $etatPartie): self
    {
        $this->etatPartie = $etatPartie;

        return $this;
    }

    public function getTourJoueur(): ?User
    {
        return $this->tourJoueur;
    }

    public function setTourJoueur(?User $tourJoueur): self
    {
        $this->tourJoueur = $tourJoueur;

        return $this;
    }

    public function getVictoire(): ?string
    {
        return $this->victoire;
    }

    public function setVistoire(string $victoire): self
    {
        $this->victoire = $victoire;

        return $this;
    }

    /**
     * @return Collection<int, MotPartie>
     */
    public function getMotParties(): Collection
    {
        return $this->motParties;
    }

    public function addMotParty(MotPartie $motParty): self
    {
        if (!$this->motParties->contains($motParty)) {
            $this->motParties->add($motParty);
            $motParty->setPartie($this);
        }

        return $this;
    }

    public function removeMotParty(MotPartie $motParty): self
    {
        if ($this->motParties->removeElement($motParty)) {
            // set the owning side to null (unless already changed)
            if ($motParty->getPartie() === $this) {
                $motParty->setPartie(null);
            }
        }

        return $this;
    }
}
