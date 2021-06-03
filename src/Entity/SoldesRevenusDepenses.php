<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SoldesRevenusDepensesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SoldesRevenusDepensesRepository::class)
 */
#[ApiResource(
    denormalizationContext:['groups'=>['write']],
    normalizationContext:['groups'=>['read']]
)]
class SoldesRevenusDepenses
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
    private $RevenuTotal;

    /**
     * @ORM\Column(type="float")
     */
    #[Groups(['read','write'])]
    private $TotalDepenses;

    /**
     * @ORM\Column(type="datetime")
     */
    #[Groups(['read','write'])]
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime")
     */
    #[Groups(['read','write'])]
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
