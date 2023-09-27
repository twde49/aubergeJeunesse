<?php

namespace App\Entity;

use App\Repository\PublicHouseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublicHouseRepository::class)]
class PublicHouse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'publicHouse', targetEntity: Dorm::class, orphanRemoval: true)]
    private Collection $dorms;

    #[ORM\Column]
    private ?int $zipCode = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $street = null;

    #[ORM\Column]
    private ?int $streetNumber = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $city = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'publicHouse')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $type = null;

    #[ORM\ManyToOne(inversedBy: 'publicHouses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?District $district = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
        $this->dorms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Dorm>
     */
    public function getDorms(): Collection
    {
        return $this->dorms;
    }

    public function addDorm(Dorm $dorm): static
    {
        if (!$this->dorms->contains($dorm)) {
            $this->dorms->add($dorm);
            $dorm->setPublicHouse($this);
        }

        return $this;
    }

    public function removeDorm(Dorm $dorm): static
    {
        if ($this->dorms->removeElement($dorm)) {
            // set the owning side to null (unless already changed)
            if ($dorm->getPublicHouse() === $this) {
                $dorm->setPublicHouse(null);
            }
        }

        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    public function setZipCode(int $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getStreetNumber(): ?int
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(int $streetNumber): static
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDistrict(): ?District
    {
        return $this->district;
    }

    public function setDistrict(?District $district): static
    {
        $this->district = $district;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
