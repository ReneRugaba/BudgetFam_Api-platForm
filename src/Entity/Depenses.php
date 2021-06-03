<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DepensesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepensesRepository::class)
 */
#[ApiResource]
class Depenses
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
    private $datePaiement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $beneficiaire;


    /**
     * @ORM\ManyToOne(targetEntity=CathegoriesDepenses::class, inversedBy="depenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cathegoriesDepenses;

    /**
     * @ORM\ManyToOne(targetEntity=Members::class, inversedBy="depenses")
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

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->datePaiement;
    }

    public function setDatePaiement(\DateTimeInterface $datePaiement): self
    {
        $this->datePaiement = $datePaiement;

        return $this;
    }

    public function getBeneficiaire(): ?string
    {
        return $this->beneficiaire;
    }

    public function setBeneficiaire(string $beneficiaire): self
    {
        $this->beneficiaire = $beneficiaire;

        return $this;
    }

    public function getCathegoriesDepenses(): ?CathegoriesDepenses
    {
        return $this->cathegoriesDepenses;
    }

    public function setCathegoriesDepenses(?CathegoriesDepenses $cathegoriesDepenses): self
    {
        $this->cathegoriesDepenses = $cathegoriesDepenses;

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
