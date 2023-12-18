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
    private ?Secteur $secteur = null;

    #[ORM\OneToMany(mappedBy: 'atelier', targetEntity: Ressource::class)]
    private Collection $ressource;

    #[ORM\OneToOne(inversedBy: 'atelier', cascade: ['persist', 'remove'])]
    private ?Salle $salle = null;

    #[ORM\ManyToMany(targetEntity: Metier::class, inversedBy: 'ateliers')]
    private Collection $metier;

    #[ORM\ManyToOne(inversedBy: 'ateliers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Edition $edition = null;

    public function __construct()
    {
        $this->ressource = new ArrayCollection();
        $this->metier = new ArrayCollection();
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
        return $this->secteur;
    }

    public function setSecteurId(?Secteur $secteur): static
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * @return Collection<int, Ressource>
     */
    public function getRessourceId(): Collection
    {
        return $this->ressource;
    }

    public function addRessourceId(Ressource $ressourceId): static
    {
        if (!$this->ressource->contains($ressourceId)) {
            $this->ressource->add($ressourceId);
            $ressourceId->setAtelier($this);
        }

        return $this;
    }

    public function removeRessourceId(Ressource $ressourceId): static
    {
        if ($this->ressource->removeElement($ressourceId)) {
            // set the owning side to null (unless already changed)
            if ($ressourceId->getAtelier() === $this) {
                $ressourceId->setAtelier(null);
            }
        }

        return $this;
    }

    public function getSalleId(): ?Salle
    {
        return $this->salle;
    }

    public function setSalleId(?Salle $salle): static
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * @return Collection<int, Metier>
     */
    public function getMetierId(): Collection
    {
        return $this->metier;
    }

    public function addMetierId(Metier $metierId): static
    {
        if (!$this->metier->contains($metierId)) {
            $this->metier->add($metierId);
        }

        return $this;
    }

    public function removeMetierId(Metier $metierId): static
    {
        $this->metier->removeElement($metierId);

        return $this;
    }

    public function getEditionId(): ?Edition
    {
        return $this->edition;
    }

    public function setEditionId(?Edition $edition): static
    {
        $this->edition = $edition;

        return $this;
    }
}
