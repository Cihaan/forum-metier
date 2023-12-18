<?php

namespace App\Entity;

use App\Repository\AtelierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AtelierRepository::class)]
class Atelier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $debut_datetime = null;

    #[ORM\ManyToOne(inversedBy: 'ateliers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Secteur $secteur_id = null;

    #[ORM\OneToMany(mappedBy: 'atelier', targetEntity: Ressource::class)]
    private Collection $ressource_id;

    #[ORM\OneToOne(inversedBy: 'atelier', cascade: ['persist', 'remove'])]
    private ?Salle $salle_id = null;

    #[ORM\ManyToMany(targetEntity: Metier::class, inversedBy: 'ateliers')]
    private Collection $metier_id;

    #[ORM\ManyToOne(inversedBy: 'ateliers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Edition $edition_id = null;

    public function __construct()
    {
        $this->ressource_id = new ArrayCollection();
        $this->metier_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebutDatetime(): ?\DateTimeInterface
    {
        return $this->debut_datetime;
    }

    public function setDebutDatetime(\DateTimeInterface $debut_datetime): static
    {
        $this->debut_datetime = $debut_datetime;

        return $this;
    }

    public function getSecteurId(): ?Secteur
    {
        return $this->secteur_id;
    }

    public function setSecteurId(?Secteur $secteur_id): static
    {
        $this->secteur_id = $secteur_id;

        return $this;
    }

    /**
     * @return Collection<int, Ressource>
     */
    public function getRessourceId(): Collection
    {
        return $this->ressource_id;
    }

    public function addRessourceId(Ressource $ressourceId): static
    {
        if (!$this->ressource_id->contains($ressourceId)) {
            $this->ressource_id->add($ressourceId);
            $ressourceId->setAtelier($this);
        }

        return $this;
    }

    public function removeRessourceId(Ressource $ressourceId): static
    {
        if ($this->ressource_id->removeElement($ressourceId)) {
            // set the owning side to null (unless already changed)
            if ($ressourceId->getAtelier() === $this) {
                $ressourceId->setAtelier(null);
            }
        }

        return $this;
    }

    public function getSalleId(): ?Salle
    {
        return $this->salle_id;
    }

    public function setSalleId(?Salle $salle_id): static
    {
        $this->salle_id = $salle_id;

        return $this;
    }

    /**
     * @return Collection<int, Metier>
     */
    public function getMetierId(): Collection
    {
        return $this->metier_id;
    }

    public function addMetierId(Metier $metierId): static
    {
        if (!$this->metier_id->contains($metierId)) {
            $this->metier_id->add($metierId);
        }

        return $this;
    }

    public function removeMetierId(Metier $metierId): static
    {
        $this->metier_id->removeElement($metierId);

        return $this;
    }

    public function getEditionId(): ?Edition
    {
        return $this->edition_id;
    }

    public function setEditionId(?Edition $edition_id): static
    {
        $this->edition_id = $edition_id;

        return $this;
    }
}
