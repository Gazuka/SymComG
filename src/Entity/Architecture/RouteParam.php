<?php

namespace App\Entity\Architecture;

use App\Repository\Architecture\RouteParamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RouteParamRepository::class)
 */
class RouteParam
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
    private $param;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $valeur;

    /**
     * @ORM\ManyToMany(targetEntity=Chemin::class, mappedBy="routeparams")
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

    public function getParam(): ?string
    {
        return $this->param;
    }

    public function setParam(string $param): self
    {
        $this->param = $param;

        return $this;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(?string $valeur): self
    {
        $this->valeur = $valeur;

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
            $chemin->addRouteparam($this);
        }

        return $this;
    }

    public function removeChemin(Chemin $chemin): self
    {
        if ($this->chemins->removeElement($chemin)) {
            $chemin->removeRouteparam($this);
        }

        return $this;
    }
}
