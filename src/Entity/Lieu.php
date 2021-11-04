<?php

namespace App\Entity;

use App\Entity\Agenda\Evenement;
use App\Entity\CarteVisite\CarteVisite;
use App\Entity\Organisme\Organisme;
use App\Repository\LieuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LieuRepository::class)
 */
class Lieu
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
     * @ORM\ManyToOne(targetEntity=Lieu::class, inversedBy="enfants")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Lieu::class, mappedBy="parent")
     */
    private $enfants;

    /**
     * @ORM\OneToOne(targetEntity=Organisme::class, inversedBy="lieu", cascade={"persist", "remove"})
     */
    private $organisme;

    /**
     * @ORM\OneToOne(targetEntity=CarteVisite::class, inversedBy="lieu", cascade={"persist", "remove"})
     */
    private $carteVisite;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, mappedBy="lieux")
     */
    private $evenements;

    public function __construct()
    {
        $this->enfants = new ArrayCollection();
        $this->evenements = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom;
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

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getEnfants(): Collection
    {
        return $this->enfants;
    }

    public function addEnfant(self $enfant): self
    {
        if (!$this->enfants->contains($enfant)) {
            $this->enfants[] = $enfant;
            $enfant->setParent($this);
        }

        return $this;
    }

    public function removeEnfant(self $enfant): self
    {
        if ($this->enfants->removeElement($enfant)) {
            // set the owning side to null (unless already changed)
            if ($enfant->getParent() === $this) {
                $enfant->setParent(null);
            }
        }

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

    public function getCarteVisite(): ?CarteVisite
    {
        return $this->carteVisite;
    }

    public function setCarteVisite(?CarteVisite $carteVisite): self
    {
        $this->carteVisite = $carteVisite;

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->addLieux($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->evenements->removeElement($evenement)) {
            $evenement->removeLieux($this);
        }

        return $this;
    }
}
