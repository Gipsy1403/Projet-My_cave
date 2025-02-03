<?php

namespace App\Entity;

use App\Repository\YearRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: YearRepository::class)]
class Year
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $year = null;

    /**
     * @var Collection<int, Bottle>
     */
    #[ORM\OneToMany(targetEntity: Bottle::class, mappedBy: 'year')]
    private Collection $bottles;

    public function __construct()
    {
        $this->bottles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

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
            $bottle->setYear($this);
        }

        return $this;
    }

    public function removeBottle(Bottle $bottle): static
    {
        if ($this->bottles->removeElement($bottle)) {
            // set the owning side to null (unless already changed)
            if ($bottle->getYear() === $this) {
                $bottle->setYear(null);
            }
        }

        return $this;
    }
}
