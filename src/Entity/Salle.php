<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalleRepository::class)]
class Salle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'salles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ecole $ecole = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $etage = null;

    #[ORM\Column]
    private ?int $capacite = null;

    #[ORM\OneToOne(mappedBy: 'salle', cascade: ['persist', 'remove'])]
    private ?Atelier $atelier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEcole(): ?Ecole
    {
        return $this->ecole;
    }

    public function setEcole(?Ecole $ecole): static
    {
        $this->ecole = $ecole;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): static
    {
        $this->etage = $etage;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getAtelier(): ?Atelier
    {
        return $this->atelier;
    }

    public function setAtelier(?Atelier $atelier): static
    {
        // unset the owning side of the relation if necessary
        if ($atelier === null && $this->atelier !== null) {
            $this->atelier->setSalle(null);
        }

        // set the owning side of the relation if necessary
        if ($atelier !== null && $atelier->getSalle() !== $this) {
            $atelier->setSalle($this);
        }

        $this->atelier = $atelier;

        return $this;
    }
}
