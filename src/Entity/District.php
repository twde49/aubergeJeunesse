<?php

namespace App\Entity;

use App\Repository\DistrictRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DistrictRepository::class)]
class District
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'district', targetEntity: PublicHouse::class)]
    private Collection $publicHouses;

    public function __construct()
    {
        $this->publicHouses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, PublicHouse>
     */
    public function getPublicHouses(): Collection
    {
        return $this->publicHouses;
    }

    public function addPublicHouse(PublicHouse $publicHouse): static
    {
        if (!$this->publicHouses->contains($publicHouse)) {
            $this->publicHouses->add($publicHouse);
            $publicHouse->setDistrict($this);
        }

        return $this;
    }

    public function removePublicHouse(PublicHouse $publicHouse): static
    {
        if ($this->publicHouses->removeElement($publicHouse)) {
            // set the owning side to null (unless already changed)
            if ($publicHouse->getDistrict() === $this) {
                $publicHouse->setDistrict(null);
            }
        }

        return $this;
    }
}
