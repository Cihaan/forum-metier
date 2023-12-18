<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Section $section_id = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ecole $ecole_id = null;

    #[ORM\ManyToMany(targetEntity: Inscription::class, mappedBy: 'edtudiant_id')]
    private Collection $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getSectionId(): ?Section
    {
        return $this->section_id;
    }

    public function setSectionId(?Section $section_id): static
    {
        $this->section_id = $section_id;

        return $this;
    }

    public function getEcoleId(): ?Ecole
    {
        return $this->ecole_id;
    }

    public function setEcoleId(?Ecole $ecole_id): static
    {
        $this->ecole_id = $ecole_id;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->addEdtudiantId($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            $inscription->removeEdtudiantId($this);
        }

        return $this;
    }
}
