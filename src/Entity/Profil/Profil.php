<?php

namespace App\Entity\Profil;

use App\Entity\Comission;
use App\Entity\Poste\Poste;
use App\Service\ClasseurService;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Classeur\Classeur;
use App\Entity\CarteVisite\CarteVisite;
use App\Repository\Profil\ProfilRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 */
class Profil
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=CarteVisite::class, inversedBy="profil", cascade={"persist", "remove"})
     */
    private $carteVisite;

    /**
     * @ORM\ManyToMany(targetEntity=Classeur::class, inversedBy="profils")
     */
    private $classeurs;

    /**
     * @ORM\OneToOne(targetEntity=Humain::class, inversedBy="profil", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $humain;

    /**
     * @ORM\ManyToMany(targetEntity=Poste::class, mappedBy="profils")
     */
    private $postes;

    /**
     * @ORM\ManyToMany(targetEntity=Comission::class, mappedBy="membres")
     */
    private $comissions;

    /**
     * @ORM\OneToMany(targetEntity=Comission::class, mappedBy="chef")
     */
    private $commissionDeleguee;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hierarchie;

    public function __construct()
    {
        $this->postes = new ArrayCollection();
        $this->classeurs = new ArrayCollection();
        $this->toto = new ArrayCollection();
        $this->comissions = new ArrayCollection();
        $this->commissionDeleguee = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->humain->getPrenom().' '.$this->humain->getNom();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|Classeur[]
     */
    public function getClasseurs(): Collection
    {
        return $this->classeurs;
    }

    public function addClasseur(Classeur $classeur): self
    {
        if (!$this->classeurs->contains($classeur)) {
            $this->classeurs[] = $classeur;
        }

        return $this;
    }

    public function removeClasseur(Classeur $classeur): self
    {
        $this->classeurs->removeElement($classeur);

        return $this;
    }

    public function getHumain(): ?Humain
    {
        return $this->humain;
    }

    public function setHumain(Humain $humain): self
    {
        $this->humain = $humain;

        return $this;
    }

    /**
     * @return Collection|Poste[]
     */
    public function getToto(): Collection
    {
        return $this->toto;
    }

    public function addToto(Poste $toto): self
    {
        if (!$this->toto->contains($toto)) {
            $this->toto[] = $toto;
            $toto->addProfil($this);
        }

        return $this;
    }

    public function removeToto(Poste $toto): self
    {
        if ($this->toto->removeElement($toto)) {
            $toto->removeProfil($this);
        }

        return $this;
    }

    /**
     * @return Collection|Poste[]
     */
    public function getPostes(): Collection
    {
        return $this->postes;
    }

    public function addPoste(Poste $poste): self
    {
        if (!$this->postes->contains($poste)) {
            $this->postes[] = $poste;
            $poste->addProfil($this);
        }

        return $this;
    }

    public function removePoste(Poste $poste): self
    {
        if ($this->postes->removeElement($poste)) {
            $poste->removeProfil($this);
        }

        return $this;
    }

    /**
     * @return Collection|Comission[]
     */
    public function getComissions(): Collection
    {
        return $this->comissions;
    }

    public function addComission(Comission $comission): self
    {
        if (!$this->comissions->contains($comission)) {
            $this->comissions[] = $comission;
            $comission->addMembre($this);
        }

        return $this;
    }

    public function removeComission(Comission $comission): self
    {
        if ($this->comissions->removeElement($comission)) {
            $comission->removeMembre($this);
        }

        return $this;
    }

    /**
     * @return Collection|Comission[]
     */
    public function getCommissionDeleguee(): Collection
    {
        return $this->commissionDeleguee;
    }

    public function addCommissionDeleguee(Comission $commissionDeleguee): self
    {
        if (!$this->commissionDeleguee->contains($commissionDeleguee)) {
            $this->commissionDeleguee[] = $commissionDeleguee;
            $commissionDeleguee->setChef($this);
        }

        return $this;
    }

    public function removeCommissionDeleguee(Comission $commissionDeleguee): self
    {
        if ($this->commissionDeleguee->removeElement($commissionDeleguee)) {
            // set the owning side to null (unless already changed)
            if ($commissionDeleguee->getChef() === $this) {
                $commissionDeleguee->setChef(null);
            }
        }

        return $this;
    }

    public function getHierarchie(): ?int
    {
        return $this->hierarchie;
    }

    public function setHierarchie(?int $hierarchie): self
    {
        $this->hierarchie = $hierarchie;

        return $this;
    }
}
