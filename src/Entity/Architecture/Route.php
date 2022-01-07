<?php

namespace App\Entity\Architecture;

use App\Repository\Architecture\RouteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RouteRepository::class)
 */
class Route
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
     * @ORM\OneToMany(targetEntity=Chemin::class, mappedBy="route")
     */
    private $chemins;

    public function __construct()
    {
        $this->chemins = new ArrayCollection();
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
     * @return Collection|Chemin[]
     */
    public function getChemins(): Collection
    {
        return $this->chemins;
    }

    public function addChemin(Chemin $chemin): self
    {
        if (!$this->chemins->contains($chemin)) {
            $this->chemins[] = $chemin;
            $chemin->setRoute($this);
        }

        return $this;
    }

    public function removeChemin(Chemin $chemin): self
    {
        if ($this->chemins->removeElement($chemin)) {
            // set the owning side to null (unless already changed)
            if ($chemin->getRoute() === $this) {
                $chemin->setRoute(null);
            }
        }

        return $this;
    }
}
