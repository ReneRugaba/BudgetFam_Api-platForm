<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MembersRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MembersRepository::class)
 */
#[ApiResource(
                normalizationContext:['groups'=>['read']],
                denormalizationContext:['groups'=>['write']]
                )]
class Members implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
     #[Groups(['read'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Regex(
     * pattern="/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/",
     * message="Votre email n'est pas valide!"
     * )
     */
    #[Groups(['read','write'])]
    private $email;
    

    /**
     * @ORM\Column(type="json")
     */
    #[Groups(['read'])]
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Regex(
     * pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",
     * message="Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character!"
     * )
     */
    #[Groups(['write'])]
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    #[Groups(['read','write'])]
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    #[Groups(['read','write'])]
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity=Depenses::class, mappedBy="members", orphanRemoval=true)
     */
    private $depenses;

    /**
     * @ORM\OneToMany(targetEntity=Revenus::class, mappedBy="members", orphanRemoval=true)
     */
    private $revenus;

    /**
     * @ORM\OneToMany(targetEntity=SoldesRevenusDepenses::class, mappedBy="members", orphanRemoval=true)
     */
    private $SoldesRevenusDepenses;

    public function __construct()
    {
        $this->depenses = new ArrayCollection();
        $this->revenus = new ArrayCollection();
        $this->SoldesRevenusDepenses = new ArrayCollection();
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
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

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection|Depenses[]
     */
    public function getDepenses(): Collection
    {
        return $this->depenses;
    }

    public function addDepense(Depenses $depense): self
    {
        if (!$this->depenses->contains($depense)) {
            $this->depenses[] = $depense;
            $depense->setMembers($this);
        }

        return $this;
    }

    public function removeDepense(Depenses $depense): self
    {
        if ($this->depenses->removeElement($depense)) {
            // set the owning side to null (unless already changed)
            if ($depense->getMembers() === $this) {
                $depense->setMembers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Revenus[]
     */
    public function getRevenus(): Collection
    {
        return $this->revenus;
    }

    public function addRevenu(Revenus $revenu): self
    {
        if (!$this->revenus->contains($revenu)) {
            $this->revenus[] = $revenu;
            $revenu->setMembers($this);
        }

        return $this;
    }

    public function removeRevenu(Revenus $revenu): self
    {
        if ($this->revenus->removeElement($revenu)) {
            // set the owning side to null (unless already changed)
            if ($revenu->getMembers() === $this) {
                $revenu->setMembers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SoldesRevenusDepenses[]
     */
    public function getSoldesRevenusDepenses(): Collection
    {
        return $this->SoldesRevenusDepenses;
    }

    public function addSoldesRevenusDepense(SoldesRevenusDepenses $soldesRevenusDepense): self
    {
        if (!$this->SoldesRevenusDepenses->contains($soldesRevenusDepense)) {
            $this->SoldesRevenusDepenses[] = $soldesRevenusDepense;
            $soldesRevenusDepense->setMembers($this);
        }

        return $this;
    }

    public function removeSoldesRevenusDepense(SoldesRevenusDepenses $soldesRevenusDepense): self
    {
        if ($this->SoldesRevenusDepenses->removeElement($soldesRevenusDepense)) {
            // set the owning side to null (unless already changed)
            if ($soldesRevenusDepense->getMembers() === $this) {
                $soldesRevenusDepense->setMembers(null);
            }
        }

        return $this;
    }
}
