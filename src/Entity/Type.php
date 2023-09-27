<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: PublicHouse::class)]
    private Collection $publicHouse;

    public function __construct()
    {
        $this->publicHouse = new ArrayCollection();
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
    public function getPublicHouse(): Collection
    {
        return $this->publicHouse;
    }

    public function addPublicHouse(PublicHouse $publicHouse): static
    {
        if (!$this->publicHouse->contains($publicHouse)) {
            $this->publicHouse->add($publicHouse);
            $publicHouse->setType($this);
        }

        return $this;
    }

    public function removePublicHouse(PublicHouse $publicHouse): static
    {
        if ($this->publicHouse->removeElement($publicHouse)) {
            // set the owning side to null (unless already changed)
            if ($publicHouse->getType() === $this) {
                $publicHouse->setType(null);
            }
        }

        return $this;
    }
}
