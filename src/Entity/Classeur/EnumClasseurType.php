<?php

namespace App\Entity\Classeur;

use App\Repository\Classeur\EnumClasseurTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnumClasseurTypeRepository::class)
 */
class EnumClasseurType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Classeur::class, mappedBy="type")
     */
    private $classeur;

    public function __construct()
    {
        $this->classeur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Classeur[]
     */
    public function getClasseur(): Collection
    {
        return $this->classeur;
    }

    public function addClasseur(Classeur $classeur): self
    {
        if (!$this->classeur->contains($classeur)) {
            $this->classeur[] = $classeur;
            $classeur->setType($this);
        }

        return $this;
    }

    public function removeClasseur(Classeur $classeur): self
    {
        if ($this->classeur->removeElement($classeur)) {
            // set the owning side to null (unless already changed)
            if ($classeur->getType() === $this) {
                $classeur->setType(null);
            }
        }

        return $this;
    }
}
