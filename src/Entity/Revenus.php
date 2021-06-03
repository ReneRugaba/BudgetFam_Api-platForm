<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RevenusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RevenusRepository::class)
 */
#[ApiResource]
class Revenus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $Montant;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateReception;

    /**
     * @ORM\ManyToOne(targetEntity=TypesRevenus::class, inversedBy="revenus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typesRevenus;

    /**
     * @ORM\ManyToOne(targetEntity=Members::class, inversedBy="revenus")
     * @ORM\JoinColumn(nullable=false)
     */
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
