<?php

namespace App\Entity;


use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BottleRepository;
use Doctrine\Common\Collections\Collection;
use symfony\component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: BottleRepository::class)]
class Bottle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;
// ajout images
    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;
    
// fin images

    #[ORM\ManyToOne(inversedBy: 'bottles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Region $region = null;

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

    #[ORM\Column(length: 4)]
    private ?int $year = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function setImageFile(?File $imageFile = null):void
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
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
}
