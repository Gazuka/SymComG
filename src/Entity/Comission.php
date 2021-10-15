<?php

namespace App\Entity;

use App\Entity\Profil\Profil;
use App\Repository\ComissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComissionRepository::class)
 */
class Comission
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
    private $titreLong;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreCourt;

    /**
     * @ORM\ManyToMany(targetEntity=Profil::class, inversedBy="comissions")
     */
    private $membres;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="commissionDeleguee")
     */
    private $chef;

    public function __construct()
    {
        $this->membres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreLong(): ?string
    {
        return $this->titreLong;
    }

    public function setTitreLong(string $titreLong): self
    {
        $this->titreLong = $titreLong;

        return $this;
    }

    public function getTitreCourt(): ?string
    {
        return $this->titreCourt;
    }

    public function setTitreCourt(string $titreCourt): self
    {
        $this->titreCourt = $titreCourt;

        return $this;
    }

    /**
     * @return Collection|Profil[]
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(Profil $membre): self
    {
        if (!$this->membres->contains($membre)) {
            $this->membres[] = $membre;
        }

        return $this;
    }

    public function removeMembre(Profil $membre): self
    {
        $this->membres->removeElement($membre);

        return $this;
    }

    public function getChef(): ?Profil
    {
        return $this->chef;
    }

    public function setChef(?Profil $chef): self
    {
        $this->chef = $chef;

        return $this;
    }
}
