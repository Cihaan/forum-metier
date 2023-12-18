<?php

namespace App\Entity;

use App\Repository\Test2Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Test2Repository::class)]
class Test2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'one_to_many', targetEntity: test1::class)]
    private Collection $test1;

    #[ORM\OneToMany(mappedBy: 'test2', targetEntity: test1::class)]
    private Collection $one_to_many;

    #[ORM\ManyToMany(targetEntity: test1::class, inversedBy: 'test2s')]
    private Collection $many_to_many;

    public function __construct()
    {
        $this->test1 = new ArrayCollection();
        $this->one_to_many = new ArrayCollection();
        $this->many_to_many = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, test1>
     */
    public function getTest1(): Collection
    {
        return $this->test1;
    }

    public function addTest1(test1 $test1): static
    {
        if (!$this->test1->contains($test1)) {
            $this->test1->add($test1);
            $test1->setOneToMany($this);
        }

        return $this;
    }

    public function removeTest1(test1 $test1): static
    {
        if ($this->test1->removeElement($test1)) {
            // set the owning side to null (unless already changed)
            if ($test1->getOneToMany() === $this) {
                $test1->setOneToMany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, test1>
     */
    public function getOneToMany(): Collection
    {
        return $this->one_to_many;
    }

    public function addOneToMany(test1 $oneToMany): static
    {
        if (!$this->one_to_many->contains($oneToMany)) {
            $this->one_to_many->add($oneToMany);
            $oneToMany->setTest2($this);
        }

        return $this;
    }

    public function removeOneToMany(test1 $oneToMany): static
    {
        if ($this->one_to_many->removeElement($oneToMany)) {
            // set the owning side to null (unless already changed)
            if ($oneToMany->getTest2() === $this) {
                $oneToMany->setTest2(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, test1>
     */
    public function getManyToMany(): Collection
    {
        return $this->many_to_many;
    }

    public function addManyToMany(test1 $manyToMany): static
    {
        if (!$this->many_to_many->contains($manyToMany)) {
            $this->many_to_many->add($manyToMany);
        }

        return $this;
    }

    public function removeManyToMany(test1 $manyToMany): static
    {
        $this->many_to_many->removeElement($manyToMany);

        return $this;
    }
}
