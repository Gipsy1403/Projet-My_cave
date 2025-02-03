<?php

namespace App\Entity;

use App\Repository\BottleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BottleRepository::class)]
class Bottle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'bottles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'bottles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Year $year = null;

    #[ORM\ManyToOne(inversedBy: 'bottles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Region $region = null;

    #[ORM\ManyToOne(inversedBy: 'bottles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $country = null;

    /**
     * @var Collection<int, Cellar>
     */
    #[ORM\ManyToMany(targetEntity: Cellar::class, inversedBy: 'bottles')]
    private Collection $cellar;

    /**
     * @var Collection<int, Grapes>
     */
    #[ORM\ManyToMany(targetEntity: Grapes::class, inversedBy: 'bottles')]
    private Collection $grapes;

    public function __construct()
    {
        $this->cellar = new ArrayCollection();
        $this->grapes = new ArrayCollection();
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getYear(): ?Year
    {
        return $this->year;
    }

    public function setYear(?Year $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): static
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection<int, Cellar>
     */
    public function getCellar(): Collection
    {
        return $this->cellar;
    }

    public function addCellar(Cellar $cellar): static
    {
        if (!$this->cellar->contains($cellar)) {
            $this->cellar->add($cellar);
        }

        return $this;
    }

    public function removeCellar(Cellar $cellar): static
    {
        $this->cellar->removeElement($cellar);

        return $this;
    }

    /**
     * @return Collection<int, Grapes>
     */
    public function getGrapes(): Collection
    {
        return $this->grapes;
    }

    public function addGrape(Grapes $grape): static
    {
        if (!$this->grapes->contains($grape)) {
            $this->grapes->add($grape);
        }

        return $this;
    }

    public function removeGrape(Grapes $grape): static
    {
        $this->grapes->removeElement($grape);

        return $this;
    }
}
