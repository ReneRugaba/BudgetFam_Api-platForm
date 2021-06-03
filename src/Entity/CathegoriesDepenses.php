<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CathegoriesDepensesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CathegoriesDepensesRepository::class)
 */
#[ApiResource(
    normalizationContext:['groups'=>['read']],
    denormalizationContext:['groups'=>['write']]
    )]
class CathegoriesDepenses
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read','write'])]
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Depenses::class, mappedBy="cathegoriesDepenses", orphanRemoval=true)
     */
    private $depenses;

    public function __construct()
    {
        $this->depenses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $depense->setCathegoriesDepenses($this);
        }

        return $this;
    }

    public function removeDepense(Depenses $depense): self
    {
        if ($this->depenses->removeElement($depense)) {
            // set the owning side to null (unless already changed)
            if ($depense->getCathegoriesDepenses() === $this) {
                $depense->setCathegoriesDepenses(null);
            }
        }

        return $this;
    }
}
