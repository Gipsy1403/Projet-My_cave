<?php

namespace App\Entity;

use App\Repository\GrapesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GrapesRepository::class)]
class Grapes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $grape = null;

    /**
     * @var Collection<int, Bottle>
     */
    #[ORM\ManyToMany(targetEntity: Bottle::class, mappedBy: 'grapes')]
    private Collection $bottles;

    public function __construct()
    {
        $this->bottles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrape(): ?string
    {
        return $this->grape;
    }

    public function setGrape(string $grape): static
    {
        $this->grape = $grape;

        return $this;
    }

    /**
     * @return Collection<int, Bottle>
     */
    public function getBottles(): Collection
    {
        return $this->bottles;
    }

    public function addBottle(Bottle $bottle): static
    {
        if (!$this->bottles->contains($bottle)) {
            $this->bottles->add($bottle);
            $bottle->addGrape($this);
        }

        return $this;
    }

    public function removeBottle(Bottle $bottle): static
    {
        if ($this->bottles->removeElement($bottle)) {
            $bottle->removeGrape($this);
        }

        return $this;
    }
}
