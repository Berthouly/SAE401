<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;


    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'string', length: 100)]
    private $resetToken;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'joueur_id', targetEntity: StatsPartie::class)]
    private Collection $statsParties;

    #[ORM\OneToMany(mappedBy: 'joueur', targetEntity: JsonPartie::class)]
    private Collection $jsonParties;

    public function __construct()
    {
        $this->parties = new ArrayCollection();
        $this->statsParties = new ArrayCollection();
        $this->jsonParties = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }

    public function setResetToken(?string $resetToken): self
    {
        $this->resetToken = $resetToken;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, StatsPartie>
     */
    public function getStatsParties(): Collection
    {
        return $this->statsParties;
    }

    public function addStatsParty(StatsPartie $statsParty): self
    {
        if (!$this->statsParties->contains($statsParty)) {
            $this->statsParties->add($statsParty);
            $statsParty->setJoueurId($this);
        }

        return $this;
    }

    public function removeStatsParty(StatsPartie $statsParty): self
    {
        if ($this->statsParties->removeElement($statsParty)) {
            // set the owning side to null (unless already changed)
            if ($statsParty->getJoueurId() === $this) {
                $statsParty->setJoueurId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, JsonPartie>
     */
    public function getJsonParties(): Collection
    {
        return $this->jsonParties;
    }

    public function addJsonParty(JsonPartie $jsonParty): self
    {
        if (!$this->jsonParties->contains($jsonParty)) {
            $this->jsonParties->add($jsonParty);
            $jsonParty->setJoueur($this);
        }

        return $this;
    }

    public function removeJsonParty(JsonPartie $jsonParty): self
    {
        if ($this->jsonParties->removeElement($jsonParty)) {
            // set the owning side to null (unless already changed)
            if ($jsonParty->getJoueur() === $this) {
                $jsonParty->setJoueur(null);
            }
        }

        return $this;
    }

}
