<?php

namespace App\Entity\Menu;

use App\Repository\Menu\CheminRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CheminRepository::class)
 */
class Chemin
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
    private $route;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $params = [];

    /**
     * @ORM\OneToOne(targetEntity=Lien::class, mappedBy="chemin", cascade={"persist", "remove"})
     */
    private $lien;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(string $route): self
    {
        $this->route = $route;

        return $this;
    }

    public function getParams(): ?array
    {
        return $this->params;
    }

    public function setParams(?array $params): self
    {
        $this->params = $params;

        return $this;
    }

    public function getLien(): ?Lien
    {
        return $this->lien;
    }

    public function setLien(?Lien $lien): self
    {
        // unset the owning side of the relation if necessary
        if ($lien === null && $this->lien !== null) {
            $this->lien->setChemin(null);
        }

        // set the owning side of the relation if necessary
        if ($lien !== null && $lien->getChemin() !== $this) {
            $lien->setChemin($this);
        }

        $this->lien = $lien;

        return $this;
    }
}
