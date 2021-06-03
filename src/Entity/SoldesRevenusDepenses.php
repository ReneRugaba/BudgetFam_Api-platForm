<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SoldesRevenusDepensesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SoldesRevenusDepensesRepository::class)
 */
#[ApiResource]
class SoldesRevenusDepenses
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
    private $RevenuTotal;

    /**
     * @ORM\Column(type="float")
     */
    private $TotalDepenses;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFin;

    /**
     * @ORM\ManyToOne(targetEntity=Members::class, inversedBy="SoldesRevenusDepenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $members;

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRevenuTotal(): ?float
    {
        return $this->RevenuTotal;
    }

    public function setRevenuTotal(float $RevenuTotal): self
    {
        $this->RevenuTotal = $RevenuTotal;

        return $this;
    }

    public function getTotalDepenses(): ?float
    {
        return $this->TotalDepenses;
    }

    public function setTotalDepenses(float $TotalDepenses): self
    {
        $this->TotalDepenses = $TotalDepenses;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

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
