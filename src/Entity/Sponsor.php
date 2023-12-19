<?php

namespace App\Entity;

use App\Repository\SponsorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SponsorRepository::class)]
class Sponsor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2048, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 2048, nullable: true)]
    private ?string $url_site = null;

    #[ORM\ManyToMany(targetEntity: Edition::class, mappedBy: 'sponsor')]
    private Collection $editions;

    public function __construct()
    {
        $this->editions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

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

    public function getUrlSite(): ?string
    {
        return $this->url_site;
    }

    public function setUrlSite(?string $url_site): static
    {
        $this->url_site = $url_site;

        return $this;
    }

    /**
     * @return Collection<int, Edition>
     */
    public function getEditions(): Collection
    {
        return $this->editions;
    }

    public function addEdition(Edition $edition): static
    {
        if (!$this->editions->contains($edition)) {
            $this->editions->add($edition);
            $edition->addSponsor($this);
        }

        return $this;
    }

    public function removeEdition(Edition $edition): static
    {
        if ($this->editions->removeElement($edition)) {
            $edition->removeSponsor($this);
        }

        return $this;
    }
}
