<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: CVModel::class, mappedBy: 'languages')]
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    
    public function __toString()
    {
        return $this->name; 
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
            $cVModel->addLanguage($this);
        }

        return $this;
    }

    public function removeCVModel(CVModel $cVModel): self
    {
        if ($this->cVModels->removeElement($cVModel)) {
            $cVModel->removeLanguage($this);
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
