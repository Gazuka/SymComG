<?php

namespace App\Entity\Visuel\Element;

use App\Entity\Visuel\ElemX;
use App\SuperEntity\Element;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Classeur\Classeur;
use App\Repository\Visuel\Element\ElemDiapoRepository;

/**
 * @ORM\Entity(repositoryClass=ElemDiapoRepository::class)
 */
class ElemDiapo extends Element
{
    public $nomClasse = 'elemDiapo';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity=ElemX::class, inversedBy="elemDiapo", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $elemX;

    /**
     * @ORM\OneToOne(targetEntity=Classeur::class, inversedBy="elemDiapo", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $classeur;

    public function __tostring()
    {
        return "debug : Diapo";
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getClasseur(): ?Classeur
    {
        return $this->classeur;
    }

    public function setClasseur(Classeur $classeur): self
    {
        $this->classeur = $classeur;

        return $this;
    }
}
