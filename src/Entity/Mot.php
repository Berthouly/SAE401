<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotRepository::class)]
#[ApiResource]
class Mot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $mot = null;

    #[ORM\OneToMany(mappedBy: 'mot', targetEntity: MotPartie::class)]
    private Collection $motParties;

    public function __construct()
    {
        $this->motParties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMot(): ?string
    {
        return $this->mot;
    }

    public function setMot(string $mot): self
    {
        $this->mot = $mot;

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
            $motParty->setMot($this);
        }

        return $this;
    }

    public function removeMotParty(MotPartie $motParty): self
    {
        if ($this->motParties->removeElement($motParty)) {
            // set the owning side to null (unless already changed)
            if ($motParty->getMot() === $this) {
                $motParty->setMot(null);
            }
        }

        return $this;
    }
}
