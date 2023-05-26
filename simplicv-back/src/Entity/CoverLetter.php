<?php

namespace App\Entity;

use App\Repository\CoverLetterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoverLetterRepository::class)]
class CoverLetter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstnameSender = null;

    #[ORM\Column(length: 255)]
    private ?string $lastnameSender = null;

    #[ORM\Column(length: 255)]
    private ?string $mailAddressSender = null;

    #[ORM\Column]
    private ?int $phoneNumberSender = null;

    #[ORM\Column(length: 255)]
    private ?string $postalAddressReceiver = null;

    #[ORM\Column]
    private ?int $zipCodeReceiver = null;

    #[ORM\Column(length: 255)]
    private ?string $cityReceiver = null;

    #[ORM\Column(length: 255)]
    private ?string $object = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateOfCreation = null;

    #[ORM\Column(length: 255)]
    private ?string $placeOfCreation = null;

    #[ORM\ManyToMany(targetEntity: CoverLetterModel::class, mappedBy: 'coverLetters')]
    private Collection $coverLetterModels;

    public function __construct()
    {
        $this->coverLetterModels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstnameSender(): ?string
    {
        return $this->firstnameSender;
    }

    public function setFirstnameSender(string $firstnameSender): self
    {
        $this->firstnameSender = $firstnameSender;

        return $this;
    }

    public function getLastnameSender(): ?string
    {
        return $this->lastnameSender;
    }

    public function setLastnameSender(string $lastnameSender): self
    {
        $this->lastnameSender = $lastnameSender;

        return $this;
    }

    public function getMailAddressSender(): ?string
    {
        return $this->mailAddressSender;
    }

    public function setMailAddressSender(string $mailAddressSender): self
    {
        $this->mailAddressSender = $mailAddressSender;

        return $this;
    }

    public function getPhoneNumberSender(): ?int
    {
        return $this->phoneNumberSender;
    }

    public function setPhoneNumberSender(int $phoneNumberSender): self
    {
        $this->phoneNumberSender = $phoneNumberSender;

        return $this;
    }

    public function getPostalAddressReceiver(): ?string
    {
        return $this->postalAddressReceiver;
    }

    public function setPostalAddressReceiver(string $postalAddressReceiver): self
    {
        $this->postalAddressReceiver = $postalAddressReceiver;

        return $this;
    }

    public function getZipCodeReceiver(): ?int
    {
        return $this->zipCodeReceiver;
    }

    public function setZipCodeReceiver(int $zipCodeReceiver): self
    {
        $this->zipCodeReceiver = $zipCodeReceiver;

        return $this;
    }

    public function getCityReceiver(): ?string
    {
        return $this->cityReceiver;
    }

    public function setCityReceiver(string $cityReceiver): self
    {
        $this->cityReceiver = $cityReceiver;

        return $this;
    }

    public function getObject(): ?string
    {
        return $this->object;
    }

    public function setObject(string $object): self
    {
        $this->object = $object;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getDateOfCreation(): ?\DateTimeInterface
    {
        return $this->dateOfCreation;
    }

    public function setDateOfCreation(\DateTimeInterface $dateOfCreation): self
    {
        $this->dateOfCreation = $dateOfCreation;

        return $this;
    }

    public function getPlaceOfCreation(): ?string
    {
        return $this->placeOfCreation;
    }

    public function setPlaceOfCreation(string $placeOfCreation): self
    {
        $this->placeOfCreation = $placeOfCreation;

        return $this;
    }

    /**
     * @return Collection<int, CoverLetterModel>
     */
    public function getCoverLetterModels(): Collection
    {
        return $this->coverLetterModels;
    }

    public function addCoverLetterModel(CoverLetterModel $coverLetterModel): self
    {
        if (!$this->coverLetterModels->contains($coverLetterModel)) {
            $this->coverLetterModels->add($coverLetterModel);
            $coverLetterModel->addCoverLetter($this);
        }

        return $this;
    }

    public function removeCoverLetterModel(CoverLetterModel $coverLetterModel): self
    {
        if ($this->coverLetterModels->removeElement($coverLetterModel)) {
            $coverLetterModel->removeCoverLetter($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->object; 
    }
}
