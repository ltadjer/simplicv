<?php

namespace App\Entity;

use App\Repository\CVModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: CVModelRepository::class)]
class CVModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $bgColor = null;

    #[ORM\Column(length: 255)]
    private ?string $textColor = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $textFont = null;

    #[ORM\Column(length: 255)]
    private ?string $titleFont = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: Formation::class, inversedBy: 'cVModels', cascade:["persist"])]
    private Collection $formations;

    #[ORM\ManyToMany(targetEntity: Experience::class, inversedBy: 'cVModels', cascade:["persist"])]
    private Collection $experiences;

    #[ORM\ManyToMany(targetEntity: Skill::class, inversedBy: 'cVModels', cascade:["persist"])]
    private Collection $skills;

    #[ORM\ManyToMany(targetEntity: Language::class, inversedBy: 'cVModels', cascade:["persist"])]
    private Collection $languages;

    #[ORM\ManyToMany(targetEntity: SocialMedias::class, inversedBy: 'cVModels', cascade:["persist"])]
    private Collection $socialMedias;

    #[ORM\ManyToOne(inversedBy: 'cVModels', cascade: ["persist"])]
    private ?Profil $profil = null;

    #[ORM\Column(length: 255)]
    private ?string $titleColor = null;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->socialMedias = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        $this->formations->removeElement($formation);

        return $this;
    }

    /**
     * @return Collection<int, Experience>
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences->add($experience);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        $this->experiences->removeElement($experience);

        return $this;
    }

    /**
     * @return Collection<int, Skill>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        $this->skills->removeElement($skill);

        return $this;
    }

    /**
     * @return Collection<int, Language>
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(Language $language): self
    {
        if (!$this->languages->contains($language)) {
            $this->languages->add($language);
        }

        return $this;
    }

    public function removeLanguage(Language $language): self
    {
        $this->languages->removeElement($language);

        return $this;
    }

    /**
     * @return Collection<int, SocialMedias>
     */
    public function getSocialMedias(): Collection
    {
        return $this->socialMedias;
    }

    public function addSocialMedia(SocialMedias $socialMedia): self
    {
        if (!$this->socialMedias->contains($socialMedia)) {
            $this->socialMedias->add($socialMedia);
        }

        return $this;
    }

    public function removeSocialMedia(SocialMedias $socialMedia): self
    {
        $this->socialMedias->removeElement($socialMedia);

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): static
    {
        $this->profil = $profil;

        return $this;
    }

    public function getTitleColor(): ?string
    {
        return $this->titleColor;
    }

    public function setTitleColor(string $titleColor): static
    {
        $this->titleColor = $titleColor;

        return $this;
    }
    
}
