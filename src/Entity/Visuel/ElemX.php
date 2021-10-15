<?php

namespace App\Entity\Visuel;

use App\Entity\Visuel\Element\ElemDiapo;
use App\Entity\Visuel\Element\ElemOrganisme;
use App\Entity\Visuel\Element\ElemTexte;
use App\Entity\Visuel\Element\ElemTitre;
use App\Entity\Visuel\Element\ElemZone;
use App\Entity\Visuel\Visuel;
use App\Repository\Visuel\ElemXRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ElemXRepository::class)
 */
class ElemX
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=ElemZone::class, mappedBy="elemX", cascade={"persist", "remove"})
     */
    private $elemZone;

    private $element = null;

    /**
     * @ORM\ManyToOne(targetEntity=ElemZone::class, inversedBy="elements")
     */
    private $parent;

    /**
     * @ORM\OneToOne(targetEntity=ElemTexte::class, mappedBy="elemX", cascade={"persist", "remove"})
     */
    private $elemTexte;

    /**
     * @ORM\OneToOne(targetEntity=ElemDiapo::class, mappedBy="elemX", cascade={"persist", "remove"})
     */
    private $elemDiapo;

    /**
     * @ORM\OneToOne(targetEntity=ElemOrganisme::class, mappedBy="elemX", cascade={"persist", "remove"})
     */
    private $elemOrganisme;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\OneToOne(targetEntity=ElemTitre::class, mappedBy="elemX", cascade={"persist", "remove"})
     */
    private $elemTitre;

    public function __construct($position = 0)
    {
        $this->position = $position;
    }

    public function getElement()
    {
        if($this->element == null)
        {
            if($this->elemZone != null)
            {
                $this->element = $this->elemZone;
            }
            if($this->elemTexte != null)
            {
                $this->element = $this->elemTexte;
            }
            if($this->elemDiapo != null)
            {
                $this->element = $this->elemDiapo;
            }
            if($this->elemOrganisme != null)
            {
                $this->element = $this->elemOrganisme;
            }
            if($this->elemTitre != null)
            {
                $this->element = $this->elemTitre;
            }
        }
        
        return $this->element;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getElemZone(): ?ElemZone
    {
        return $this->elemZone;
    }

    public function setElemZone(ElemZone $elemZone): self
    {
        // set the owning side of the relation if necessary
        if ($elemZone->getElemX() !== $this) {
            $elemZone->setElemX($this);
        }

        $this->elemZone = $elemZone;

        return $this;
    }

    public function getParent(): ?ElemZone
    {
        return $this->parent;
    }

    public function setParent(?ElemZone $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getElemTexte(): ?ElemTexte
    {
        return $this->elemTexte;
    }

    public function setElemTexte(ElemTexte $elemTexte): self
    {
        // set the owning side of the relation if necessary
        if ($elemTexte->getElemX() !== $this) {
            $elemTexte->setElemX($this);
        }

        $this->elemTexte = $elemTexte;

        return $this;
    }

    public function getElemDiapo(): ?ElemDiapo
    {
        return $this->elemDiapo;
    }

    public function setElemDiapo(ElemDiapo $elemDiapo): self
    {
        // set the owning side of the relation if necessary
        if ($elemDiapo->getElemX() !== $this) {
            $elemDiapo->setElemX($this);
        }

        $this->elemDiapo = $elemDiapo;

        return $this;
    }

    public function getElemOrganisme(): ?ElemOrganisme
    {
        return $this->elemOrganisme;
    }

    public function setElemOrganisme(ElemOrganisme $elemOrganisme): self
    {
        // set the owning side of the relation if necessary
        if ($elemOrganisme->getElemX() !== $this) {
            $elemOrganisme->setElemX($this);
        }

        $this->elemOrganisme = $elemOrganisme;

        return $this;
    }

    public function getVisuel(): Visuel
    {
        return $this->parent->getVisuel();
    }

    public function getElemTitre(): ?ElemTitre
    {
        return $this->elemTitre;
    }

    public function setElemTitre(ElemTitre $elemTitre): self
    {
        // set the owning side of the relation if necessary
        if ($elemTitre->getElemX() !== $this) {
            $elemTitre->setElemX($this);
        }

        $this->elemTitre = $elemTitre;

        return $this;
    }

    public function testSiAssociationLiee()
    {
        $associationLiee = false;
        if($this->elemOrganisme->testSiAssociationLiee() == true)
        {
            $associationLiee = true;
        }        
        return $associationLiee;
    }
}
