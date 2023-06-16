<?php

namespace App\Entity;

use App\Repository\CoverLetterModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoverLetterModelRepository::class)]
class CoverLetterModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $textFont = null;

    #[ORM\Column(length: 255)]
    private ?string $titleFont = null;

    #[ORM\Column(length: 255)]
    private ?string $bgColor = null;

    #[ORM\Column(length: 255)]
    private ?string $textColor = null;

    #[ORM\Column(length: 255)]
    private ?string $titleColor = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'coverLetterModels')]
    private ?CoverLetter $coverLetter = null;

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

    public function getTextFont(): ?string
    {
        return $this->textFont;
    }

    public function setTextFont(string $textFont): self
    {
        $this->textFont = $textFont;

        return $this;
    }

    public function getTitleFont(): ?string
    {
        return $this->titleFont;
    }

    public function setTitleFont(string $titleFont): self
    {
        $this->titleFont = $titleFont;

        return $this;
    }

    public function getBgColor(): ?string
    {
        return $this->bgColor;
    }

    public function setBgColor(string $bgColor): self
    {
        $this->bgColor = $bgColor;

        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(string $textColor): self
    {
        $this->textColor = $textColor;

        return $this;
    }

    public function getTitleColor(): ?string
    {
        return $this->titleColor;
    }

    public function setTitleColor(string $titleColor): self
    {
        $this->titleColor = $titleColor;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCoverLetter(): ?CoverLetter
    {
        return $this->coverLetter;
    }

    public function setCoverLetter(?CoverLetter $coverLetter): static
    {
        $this->coverLetter = $coverLetter;

        return $this;
    }

}
