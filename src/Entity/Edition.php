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

    #[ORM\OneToOne(mappedBy: 'edition', cascade: ['persist', 'remove'])]
    private ?Questionnaire $questionnaire = null;

    #[ORM\OneToMany(mappedBy: 'edition', targetEntity: Atelier::class)]
    private Collection $ateliers;

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
    public function getSponsor(): Collection
    {
        return $this->sponsor;
    }

    public function addSponsor(Sponsor $sponsor): static
    {
        if (!$this->sponsor->contains($sponsor)) {
            $this->sponsor->add($sponsor);
        }

        return $this;
    }

    public function removeSponsor(Sponsor $sponsor): static
    {
        $this->sponsor->removeElement($sponsor);

        return $this;
    }

    public function getQuestionnaire(): ?Questionnaire
    {
        return $this->questionnaire;
    }

    public function setQuestionnaire(Questionnaire $questionnaire): static
    {
        // set the owning side of the relation if necessary
        if ($questionnaire->getEdition() !== $this) {
            $questionnaire->setEdition($this);
        }

        $this->questionnaire = $questionnaire;

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
            $atelier->setEdition($this);
        }

        return $this;
    }

    public function removeAtelier(Atelier $atelier): static
    {
        if ($this->ateliers->removeElement($atelier)) {
            // set the owning side to null (unless already changed)
            if ($atelier->getEdition() === $this) {
                $atelier->setEdition(null);
            }
        }

        return $this;
    }
}
