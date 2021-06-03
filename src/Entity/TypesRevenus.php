<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypesRevenusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TypesRevenusRepository::class)
 */
#[ApiResource(
    denormalizationContext:['groups'=>['read']],
    normalizationContext:['groups'=>['write']]
)]
class TypesRevenus
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
     * @ORM\OneToMany(targetEntity=Revenus::class, mappedBy="typesRevenus", orphanRemoval=true)
     */
    private $revenus;

    public function __construct()
    {
        $this->revenus = new ArrayCollection();
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
            $revenu->setTypesRevenus($this);
        }

        return $this;
    }

    public function removeRevenu(Revenus $revenu): self
    {
        if ($this->revenus->removeElement($revenu)) {
            // set the owning side to null (unless already changed)
            if ($revenu->getTypesRevenus() === $this) {
                $revenu->setTypesRevenus(null);
            }
        }

        return $this;
    }
}
