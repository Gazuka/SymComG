<?php

namespace App\Entity\Poste;

use App\Entity\CarteVisite\CarteVisite;
use App\Entity\Profil\Profil;
use App\Entity\Organisme\Organisme;
use App\Repository\Poste\PosteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PosteRepository::class)
 */
class Poste
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Fonction::class, inversedBy="postes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fonction;

    /**
     * @ORM\ManyToOne(targetEntity=Secteur::class, inversedBy="postes")
     */
    private $secteur;

    /**
     * @ORM\ManyToOne(targetEntity=Organisme::class, inversedBy="postes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisme;

    /**
     * @ORM\ManyToOne(targetEntity=Statut::class, inversedBy="postes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statut;

    /**
     * @ORM\ManyToMany(targetEntity=Profil::class, inversedBy="postes")
     * @ORM\OrderBy({"hierarchie" = "ASC"})
     */
    private $profils;

    /**
     * @ORM\OneToOne(targetEntity=CarteVisite::class, inversedBy="poste", cascade={"persist", "remove"})
     */
    private $carteVisite;

    public function __construct()
    {
        $this->postes = new ArrayCollection();
        $this->profil = new ArrayCollection();
        $this->profils = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFonction(): ?Fonction
    {
        return $this->fonction;
    }

    public function setFonction(?Fonction $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getSecteur(): ?Secteur
    {
        return $this->secteur;
    }

    public function setSecteur(?Secteur $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }

    public function getOrganisme(): ?Organisme
    {
        return $this->organisme;
    }

    public function setOrganisme(?Organisme $organisme): self
    {
        $this->organisme = $organisme;

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|Profil[]
     */
    public function getProfils(): Collection
    {
        return $this->profils;
    }

    public function addProfil(Profil $profil): self
    {
        if (!$this->profils->contains($profil)) {
            $this->profils[] = $profil;
        }

        return $this;
    }

    public function removeProfil(Profil $profil): self
    {
        $this->profils->removeElement($profil);

        return $this;
    }

    public function getCarteVisite(): ?CarteVisite
    {
        return $this->carteVisite;
    }

    public function setCarteVisite(?CarteVisite $carteVisite): self
    {
        $this->carteVisite = $carteVisite;

        return $this;
    }
}