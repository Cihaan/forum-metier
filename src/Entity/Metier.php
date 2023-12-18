<?php

namespace App\Entity;

use App\Repository\MetierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetierRepository::class)]
class Metier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: Competence::class, inversedBy: 'metiers')]
    private Collection $competence_id;

    #[ORM\ManyToMany(targetEntity: Activite::class, inversedBy: 'metiers')]
    private Collection $activite_id;

    #[ORM\ManyToMany(targetEntity: Atelier::class, mappedBy: 'metier_id')]
    private Collection $ateliers;

    public function __construct()
    {
        $this->competence_id = new ArrayCollection();
        $this->activite_id = new ArrayCollection();
        $this->ateliers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Competence>
     */
    public function getCompetenceId(): Collection
    {
        return $this->competence_id;
    }

    public function addCompetenceId(Competence $competenceId): static
    {
        if (!$this->competence_id->contains($competenceId)) {
            $this->competence_id->add($competenceId);
        }

        return $this;
    }

    public function removeCompetenceId(Competence $competenceId): static
    {
        $this->competence_id->removeElement($competenceId);

        return $this;
    }

    /**
     * @return Collection<int, Activite>
     */
    public function getAcriviteId(): Collection
    {
        return $this->activite_id;
    }

    public function addAcriviteId(Activite $acriviteId): static
    {
        if (!$this->activite_id->contains($acriviteId)) {
            $this->activite_id->add($acriviteId);
        }

        return $this;
    }

    public function removeAcriviteId(Activite $acriviteId): static
    {
        $this->activite_id->removeElement($acriviteId);

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
            $atelier->addMetierId($this);
        }

        return $this;
    }

    public function removeAtelier(Atelier $atelier): static
    {
        if ($this->ateliers->removeElement($atelier)) {
            $atelier->removeMetierId($this);
        }

        return $this;
    }
}
