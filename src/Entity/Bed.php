<?php

namespace App\Entity;

use App\Repository\BedRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BedRepository::class)]
class Bed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $booked = null;

    #[ORM\Column]
    private ?bool $betterBlanket = null;

    #[ORM\Column]
    private ?bool $betterPillow = null;

    #[ORM\ManyToOne(inversedBy: 'beds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Dorm $dorm = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isBooked(): ?bool
    {
        return $this->booked;
    }

    public function setBooked(bool $booked): static
    {
        $this->booked = $booked;

        return $this;
    }

    public function isBetterBlanket(): ?bool
    {
        return $this->betterBlanket;
    }

    public function setBetterBlanket(bool $betterBlanket): static
    {
        $this->betterBlanket = $betterBlanket;

        return $this;
    }

    public function isBetterPillow(): ?bool
    {
        return $this->betterPillow;
    }

    public function setBetterPillow(bool $betterPillow): static
    {
        $this->betterPillow = $betterPillow;

        return $this;
    }

    public function getDorm(): ?Dorm
    {
        return $this->dorm;
    }

    public function setDorm(?Dorm $dorm): static
    {
        $this->dorm = $dorm;

        return $this;
    }
}
