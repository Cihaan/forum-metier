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
    private Collection $competence;

    #[ORM\ManyToMany(targetEntity: Activite::class, inversedBy: 'metiers')]
    private Collection $activite;

    #[ORM\ManyToMany(targetEntity: Atelier::class, mappedBy: 'metier')]
    private Collection $ateliers;

    public function __construct()
    {
        $this->competence = new ArrayCollection();
        $this->activite = new ArrayCollection();
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
        return $this->competence;
    }

    public function addCompetenceId(Competence $competenceId): static
    {
        if (!$this->competence->contains($competenceId)) {
            $this->competence->add($competenceId);
        }

        return $this;
    }

    public function removeCompetenceId(Competence $competenceId): static
    {
        $this->competence->removeElement($competenceId);

        return $this;
    }

    /**
     * @return Collection<int, Activite>
     */
    public function getActiviteId(): Collection
    {
        return $this->activite;
    }

    public function addActiviteId(Activite $activiteId): static
    {
        if (!$this->activite->contains($activiteId)) {
            $this->activite->add($activiteId);
        }

        return $this;
    }

    public function removeActiviteId(Activite $activiteId): static
    {
        $this->activite->removeElement($activiteId);

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
