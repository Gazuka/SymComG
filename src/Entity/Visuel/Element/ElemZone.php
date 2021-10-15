<?php

namespace App\Entity\Visuel\Element;

use App\Entity\Visuel\ElemX;
use App\SuperEntity\Element;
use App\Entity\Visuel\Visuel;
use App\Repository\Visuel\Element\ElemZoneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ElemZoneRepository::class)
 */
class ElemZone extends Element
{
    public $nomClasse = 'zone';

    /**
     * @ORM\OneToOne(targetEntity=ElemX::class, inversedBy="elemZone", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $elemX;

    /**
     * @ORM\OneToMany(targetEntity=ElemX::class, mappedBy="parent")     * 
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $elements;

    /**
     * @ORM\Column(type="integer")
     */
    private $tailleXl;

    /**
     * @ORM\OneToOne(targetEntity=Visuel::class, mappedBy="elemZone", cascade={"persist", "remove"})
     */
    private $visuel;

    public function __construct()
    {
        parent::__construct();
        $this->tailleXl = 12;
        $this->elements = new ArrayCollection();               
    }

    public function getElemX(): ?ElemX
    {
        return $this->elemX;
    }

    public function setElemX(ElemX $elemX): self
    {
        $this->elemX = $elemX;

        return $this;
    }

    /**
     * @return Collection|ElemX[]
     */
    public function getElements(): Collection
    {
        return $this->elements;
    }

    public function addElement(ElemX $element): self
    {
        if($element->getPosition() == 0)
        {
            $element->setPosition(sizeOf($this->elements)+1);
        }
        if (!$this->elements->contains($element)) {
            $this->elements[] = $element;
            $element->setParent($this);
        }

        return $this;
    }

    public function removeElement(ElemX $element): self
    {
        $this->gererPositionsSuppression($element);
        if ($this->elements->removeElement($element)) {
            // set the owning side to null (unless already changed)
            if ($element->getParent() === $this) {
                $element->setParent(null);
            }
        }

        return $this;
    }

    public function getApercu($apercu)
    {
        if($apercu == null)
        {
            foreach($this->elements as $elemX)
            {
                //Si apercu est null, on cherche à le remplir sinon on passe son chemin...
                if($apercu == null)
                {
                    $apercu = $elemX->getElement()->getApercu($apercu);
                }
            }
        }
        return $apercu;
    }

    public function getTailleXl(): ?int
    {
        return $this->tailleXl;
    }

    public function setTailleXl(int $tailleXl): self
    {
        $this->tailleXl = $tailleXl;

        return $this;
    }

    public function getVisuel(): ?Visuel
    {
        if($this->visuel == null)
        {
            $visuel = $this->elemX->getVisuel();
        }
        else
        {
            $visuel = $this->visuel;
        }
        return $visuel;
    }

    public function setVisuel(Visuel $visuel): self
    {
        // set the owning side of the relation if necessary
        if ($visuel->getElemZone() !== $this) {
            $visuel->setElemZone($this);
        }

        $this->visuel = $visuel;

        return $this;
    }

    public function baissePosition(ElemX $element): self
    {
        //On récupère la position d'origine de l'élément
        $positionOrigine = $element->getPosition();
        //Si la position est déjà à 1 on ne peut pas passer à 0 et il ne se passe rien...
        if($positionOrigine > 1)
        {
            //On augmente la position inférieure de 1
            foreach($this->elements as $autreElement)
            {
                if($autreElement->getPosition() == $positionOrigine-1)
                {
                    $autreElement->setPosition($positionOrigine);
                }
            }
            //On change la position de l'élément
            $element->setPosition($positionOrigine-1);
        }

        return $this;
    }

    public function montePosition(ElemX $element): self
    {
        //On récupère la position d'origine de l'élément
        $positionOrigine = $element->getPosition();
        //Si la position est déjà au max on ne peut pas l'augmenter...
        if($positionOrigine < sizeOf($this->elements))
        {
            //On diminu la position supérieure de 1
            foreach($this->elements as $autreElement)
            {
                if($autreElement->getPosition() == $positionOrigine+1)
                {
                    $autreElement->setPosition($positionOrigine);
                }
            }
            //On change la position de l'élément
            $element->setPosition($positionOrigine+1);
        }

        return $this;
    }

    private function gererPositionsSuppression(ElemX $element): self
    {
        //On récupère la position d'origine de l'élément à supprimer
        $positionOrigine = $element->getPosition();
        //On baisse la position de tous les élements avec une position suppérieure
        foreach($this->elements as $autreElement)
        {
            $positionElementActif = $autreElement->getPosition();
            if($positionElementActif > $positionOrigine)
            {
                $autreElement->setPosition($positionElementActif - 1);
            }
        }
        return $this;
    }

    public function testSiAssociationLiee()
    {
        $associationLiee = false;
        foreach($this->elements as $elemX)
        {
            if($elemX->getElement()->nomClasse == 'zone' || $elemX->getElement()->nomClasse == 'elemOrganisme')
            {
                if($elemX->getElement()->testSiAssociationLiee() == true)
                {
                    $associationLiee = true;
                }
            }
        }
        return $associationLiee;
    }

}
