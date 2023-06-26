<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $degree = null;

    #[ORM\Column(length: 255)]
    private ?string $nameSchool = null;

    #[ORM\Column(length: 255)]
    private ?string $locationSchool = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: CVModel::class, mappedBy: 'formations')]
    private Collection $cVModels;

    // #[ORM\Column]
    // private ?int $position = null;

    public function __construct()
    {
        $this->cVModels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDegree(): ?string
    {
        return $this->degree;
    }

    public function setDegree(string $degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    public function getNameSchool(): ?string
    {
        return $this->nameSchool;
    }

    public function setNameSchool(string $nameSchool): self
    {
        $this->nameSchool = $nameSchool;

        return $this;
    }

    public function getLocationSchool(): ?string
    {
        return $this->locationSchool;
    }

    public function setLocationSchool(string $locationSchool): self
    {
        $this->locationSchool = $locationSchool;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function __toString()
    {
        return $this->degree; 
    }

    /**
     * @return Collection<int, CVModel>
     */
    public function getCVModels(): Collection
    {
        return $this->cVModels;
    }

    public function addCVModel(CVModel $cVModel): self
    {
        if (!$this->cVModels->contains($cVModel)) {
            $this->cVModels->add($cVModel);
            $cVModel->addFormation($this);
        }

        return $this;
    }

    public function removeCVModel(CVModel $cVModel): self
    {
        if ($this->cVModels->removeElement($cVModel)) {
            $cVModel->removeFormation($this);
        }

        return $this;
    }

    // public function getPosition(): ?int
    // {
    //     return $this->position;
    // }

    // public function setPosition(int $position): static
    // {
    //     $this->position = $position;

    //     return $this;
    // }

}
