<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkillRepository::class)]
class Skill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: CVModel::class, mappedBy: 'skills')]
    private Collection $cVModels;

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
            $cVModel->addSkill($this);
        }

        return $this;
    }

    public function removeCVModel(CVModel $cVModel): self
    {
        if ($this->cVModels->removeElement($cVModel)) {
            $cVModel->removeSkill($this);
        }

        return $this;
    }
}
