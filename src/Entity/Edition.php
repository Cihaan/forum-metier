<?php

namespace App\Entity;

use App\Repository\EditionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditionRepository::class)]
class Edition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $annee = null;

    #[ORM\ManyToMany(targetEntity: Sponsor::class, inversedBy: 'editions')]
    private Collection $sponsor;

    #[ORM\OneToMany(mappedBy: 'edition', targetEntity: Atelier::class)]
    private Collection $ateliers;

    #[ORM\Column(length: 2048, nullable: true)]
    private ?string $questionaire_url = null;

    public function __construct()
    {
        $this->sponsor = new ArrayCollection();
        $this->ateliers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * @return Collection<int, Sponsor>
     */
    public function getSponsorId(): Collection
    {
        return $this->sponsor;
    }

    public function addSponsorId(Sponsor $sponsorId): static
    {
        if (!$this->sponsor->contains($sponsorId)) {
            $this->sponsor->add($sponsorId);
        }

        return $this;
    }

    public function removeSponsorId(Sponsor $sponsorId): static
    {
        $this->sponsor->removeElement($sponsorId);

        return $this;
    }

    /**
     * @return Collection<int, Atelier>
     */
    public function getAteliers(): Collection
    {
        return $this->ateliers;
    }

    public function addAtelier(Atelier $atelier): static
    {
        if (!$this->ateliers->contains($atelier)) {
            $this->ateliers->add($atelier);
            $atelier->setEditionId($this);
        }

        return $this;
    }

    public function removeAtelier(Atelier $atelier): static
    {
        if ($this->ateliers->removeElement($atelier)) {
            // set the owning side to null (unless already changed)
            if ($atelier->getEditionId() === $this) {
                $atelier->setEditionId(null);
            }
        }

        return $this;
    }

    public function getQuestionaireUrl(): ?string
    {
        return $this->questionaire_url;
    }

    public function setQuestionaireUrl(?string $questionaire_url): static
    {
        $this->questionaire_url = $questionaire_url;

        return $this;
    }
}
