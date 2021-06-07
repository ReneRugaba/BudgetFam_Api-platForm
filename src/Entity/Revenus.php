<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RevenusRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RevenusRepository::class)
 */
#[ApiResource(
    normalizationContext:['groups'=>['read']],
    denormalizationContext:['groups'=>['write']]
    )]
class Revenus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read'])]
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    #[Groups(['read','write'])]
    private $Montant;

    /**
     * @ORM\Column(type="datetime")
     */
    #[Groups(['read','write'])]
    private $dateReception;

    /**
     * @ORM\ManyToOne(targetEntity=TypesRevenus::class, inversedBy="revenus")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['read'])]
    private $typesRevenus;

    /**
     * @ORM\ManyToOne(targetEntity=Members::class, inversedBy="revenus")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['read'])]
    private $members;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->Montant;
    }

    public function setMontant(float $Montant): self
    {
        $this->Montant = $Montant;

        return $this;
    }

    public function getDateReception(): ?\DateTimeInterface
    {
        return $this->dateReception;
    }

    public function setDateReception(\DateTimeInterface $dateReception): self
    {
        $this->dateReception = $dateReception;

        return $this;
    }

    public function getTypesRevenus(): ?TypesRevenus
    {
        return $this->typesRevenus;
    }

    public function setTypesRevenus(?TypesRevenus $typesRevenus): self
    {
        $this->typesRevenus = $typesRevenus;

        return $this;
    }

    public function getMembers(): ?Members
    {
        return $this->members;
    }

    public function setMembers(?Members $members): self
    {
        $this->members = $members;

        return $this;
    }
}
