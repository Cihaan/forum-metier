<?php

namespace App\Entity;

use App\Repository\Test1Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Test1Repository::class)]
class Test1
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'test1')]
    private ?Test2 $one_to_many = null;

    #[ORM\ManyToOne(inversedBy: 'one_to_many')]
    private ?Test2 $test2 = null;

    #[ORM\ManyToMany(targetEntity: Test2::class, mappedBy: 'many_to_many')]
    private Collection $test2s;

    public function __construct()
    {
        $this->test2s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getOneToMany(): ?Test2
    {
        return $this->one_to_many;
    }

    public function setOneToMany(?Test2 $one_to_many): static
    {
        $this->one_to_many = $one_to_many;

        return $this;
    }

    public function getTest2(): ?Test2
    {
        return $this->test2;
    }

    public function setTest2(?Test2 $test2): static
    {
        $this->test2 = $test2;

        return $this;
    }

    /**
     * @return Collection<int, Test2>
     */
    public function getTest2s(): Collection
    {
        return $this->test2s;
    }

    public function addTest2(Test2 $test2): static
    {
        if (!$this->test2s->contains($test2)) {
            $this->test2s->add($test2);
            $test2->addManyToMany($this);
        }

        return $this;
    }

    public function removeTest2(Test2 $test2): static
    {
        if ($this->test2s->removeElement($test2)) {
            $test2->removeManyToMany($this);
        }

        return $this;
    }
}
