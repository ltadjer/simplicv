<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProfilRepository::class)]
#[Vich\Uploadable]

class Profil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\Column]
    private ?int $phoneNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $postalAddress = null;

    #[ORM\Column]
    private ?int $zipCode = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $drivingLicence = null;

    #[ORM\Column(length: 255)]
    private ?string $mailAddress = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;
    

    #[ORM\OneToMany(mappedBy: 'profil', targetEntity: CVModel::class)]
    private Collection $cVModels;

    #[Vich\UploadableField(mapping: 'images_profils', fileNameProperty: 'image')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

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

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(int $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getPostalAddress(): ?string
    {
        return $this->postalAddress;
    }

    public function setPostalAddress(string $postalAddress): self
    {
        $this->postalAddress = $postalAddress;

        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    public function setZipCode(int $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDrivingLicence(): ?string
    {
        return $this->drivingLicence;
    }

    public function setDrivingLicence(?string $drivingLicence): self
    {
        $this->drivingLicence = $drivingLicence;

        return $this;
    }

    public function getMailAddress(): ?string
    {
        return $this->mailAddress;
    }

    public function setMailAddress(string $mailAddress): self
    {
        $this->mailAddress = $mailAddress;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    public function __toString()
    {
        return $this->title;
    }

    /**
     * @return Collection<int, CVModel>
     */
    public function getCVModels(): Collection
    {
        return $this->cVModels;
    }

    public function addCVModel(CVModel $cVModel): static
    {
        if (!$this->cVModels->contains($cVModel)) {
            $this->cVModels->add($cVModel);
            $cVModel->setProfil($this);
        }

        return $this;
    }

    public function removeCVModel(CVModel $cVModel): static
    {
        if ($this->cVModels->removeElement($cVModel)) {
            // set the owning side to null (unless already changed)
            if ($cVModel->getProfil() === $this) {
                $cVModel->setProfil(null);
            }
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
