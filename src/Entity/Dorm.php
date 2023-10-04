<?php

namespace App\Entity;

use App\Repository\DormRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DormRepository::class)]
class Dorm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;


    #[ORM\ManyToOne(inversedBy: 'dorms')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PublicHouse $publicHouse = null;

    #[ORM\OneToMany(mappedBy: 'dorm', targetEntity: Booking::class, orphanRemoval: true)]
    private Collection $booking;

    #[ORM\OneToMany(mappedBy: 'dorm', targetEntity: Bed::class, orphanRemoval: true)]
    private Collection $beds;

    #[ORM\Column]
    private ?float $pricePerNight = null;

    public function __construct()
    {
        $this->booking = new ArrayCollection();
        $this->beds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }
    

    public function getPublicHouse(): ?PublicHouse
    {
        return $this->publicHouse;
    }

    public function setPublicHouse(?PublicHouse $publicHouse): static
    {
        $this->publicHouse = $publicHouse;

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBooking(): Collection
    {
        return $this->booking;
    }

    public function addBooking(Booking $booking): static
    {
        if (!$this->booking->contains($booking)) {
            $this->booking->add($booking);
            $booking->setDorm($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->booking->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getDorm() === $this) {
                $booking->setDorm(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Bed>
     */
    public function getBeds(): Collection
    {
        return $this->beds;
    }

    public function addBed(Bed $bed): static
    {
        if (!$this->beds->contains($bed)) {
            $this->beds->add($bed);
            $bed->setDorm($this);
        }

        return $this;
    }

    public function removeBed(Bed $bed): static
    {
        if ($this->beds->removeElement($bed)) {
            // set the owning side to null (unless already changed)
            if ($bed->getDorm() === $this) {
                $bed->setDorm(null);
            }
        }

        return $this;
    }

    public function getPricePerNight(): ?float
    {
        return $this->pricePerNight;
    }

    public function setPricePerNight(float $pricePerNight): static
    {
        $this->pricePerNight = $pricePerNight;

        return $this;
    }
}
