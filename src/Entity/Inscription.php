<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Etudiant::class, inversedBy: 'inscriptions')]
    private Collection $edtudiant;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?bool $statut_chiffrement = null;

    public function __construct()
    {
        $this->edtudiant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Etudiant>
     */
    public function getEdtudiantId(): Collection
    {
        return $this->edtudiant;
    }

    public function addEdtudiantId(Etudiant $edtudiantId): static
    {
        if (!$this->edtudiant->contains($edtudiantId)) {
            $this->edtudiant->add($edtudiantId);
        }

        return $this;
    }

    public function removeEdtudiantId(Etudiant $edtudiantId): static
    {
        $this->edtudiant->removeElement($edtudiantId);

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function isStatutChiffrement(): ?bool
    {
        return $this->statut_chiffrement;
    }

    public function setStatutChiffrement(bool $statut_chiffrement): static
    {
        $this->statut_chiffrement = $statut_chiffrement;

        return $this;
    }
}
