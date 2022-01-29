<?php

namespace App\Entity\Poste;

use App\Repository\Poste\FonctionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FonctionRepository::class)
 */
class Fonction
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titreFeminin;

    /**
     * @ORM\OneToMany(targetEntity=Poste::class, mappedBy="fonction")
     */
    private $postes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titrePluriel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreFemininPluriel;

    public function __toString()
    {
        return $this->getTitreWithSexe(null);
    }

    public function __construct()
    {
        $this->postes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreWithSexe($sexe)
    {
        $affichage = $this->titre;        
        if($this->titreFeminin != null)
        {
            if($sexe == null)
            {
                // On propose Masculin / Féminin
                $affichage = $affichage.' / '.$this->titreFeminin;
            }
            else
            {
                if($sexe == 'f')
                {
                    $affichage = $this->titreFeminin;
                }
            }            
        }
        return $affichage;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTitreFeminin(): ?string
    {
        return $this->titreFeminin;
    }

    public function setTitreFeminin(string $titreFeminin): self
    {
        $this->titreFeminin = $titreFeminin;

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
            $poste->setFonction($this);
        }

        return $this;
    }

    public function removePoste(Poste $poste): self
    {
        if ($this->postes->removeElement($poste)) {
            // set the owning side to null (unless already changed)
            if ($poste->getFonction() === $this) {
                $poste->setFonction(null);
            }
        }

        return $this;
    }

    public function getTitrePluriel(): ?string
    {
        return $this->titrePluriel;
    }

    public function setTitrePluriel(string $titrePluriel): self
    {
        $this->titrePluriel = $titrePluriel;

        return $this;
    }

    public function getTitreFemininPluriel(): ?string
    {
        return $this->titreFemininPluriel;
    }

    public function setTitreFemininPluriel(string $titreFemininPluriel): self
    {
        $this->titreFemininPluriel = $titreFemininPluriel;

        return $this;
    }
}
