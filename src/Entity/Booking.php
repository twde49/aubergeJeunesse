<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeInterface $arrivedDate = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeInterface $leavingDate = null;

    #[ORM\Column]
    private ?int $customers = null;

    #[ORM\Column]
    private ?int $numberOfNights = null;

    #[ORM\Column]
    private ?bool $breakfastOption = null;

    #[ORM\ManyToOne(inversedBy: 'booking')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Dorm $dorm = null;

    #[ORM\Column]
    private ?bool $betterPillow = null;

    #[ORM\Column]
    private ?bool $betterBlanket = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $ofUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArrivedDate(): ?\DateTimeInterface
    {
        return $this->arrivedDate;
    }

    public function setArrivedDate(\DateTimeInterface $arrivedDate): static
    {
        $this->arrivedDate = $arrivedDate;

        return $this;
    }

    public function getLeavingDate(): ?\DateTimeInterface
    {
        return $this->leavingDate;
    }

    public function setLeavingDate(\DateTimeInterface $leavingDate): static
    {
        $this->leavingDate = $leavingDate;

        return $this;
    }

    public function getCustomers(): ?int
    {
        return $this->customers;
    }

    public function setCustomers(int $customers): static
    {
        $this->customers = $customers;

        return $this;
    }

    public function getNumberOfNights(): ?int
    {
        return $this->numberOfNights;
    }

    public function setNumberOfNights(int $numberOfNights): static
    {
        $this->numberOfNights = $numberOfNights;

        return $this;
    }

    public function isBreakfastOption(): ?bool
    {
        return $this->breakfastOption;
    }

    public function setBreakfastOption(bool $breakfastOption): static
    {
        $this->breakfastOption = $breakfastOption;

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

    public function isBetterPillow(): ?bool
    {
        return $this->betterPillow;
    }

    public function setBetterPillow(bool $betterPillow): static
    {
        $this->betterPillow = $betterPillow;

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

    public function getOfUser(): ?User
    {
        return $this->ofUser;
    }

    public function setOfUser(?User $ofUser): static
    {
        $this->ofUser = $ofUser;

        return $this;
    }
}
