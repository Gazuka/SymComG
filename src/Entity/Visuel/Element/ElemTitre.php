<?php

namespace App\Entity\Visuel\Element;

use App\Entity\Visuel\ElemX;
use App\SuperEntity\Element;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Visuel\Element\ElemTitreRepository;

/**
 * @ORM\Entity(repositoryClass=ElemTitreRepository::class)
 */
class ElemTitre extends Element
{
    public $nomClasse = 'titre';

    /**
     * @ORM\OneToOne(targetEntity=ElemX::class, inversedBy="elemTitre", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $elemX;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    public function getElemX(): ?ElemX
    {
        return $this->elemX;
    }

    public function setElemX(ElemX $elemX): self
    {
        $this->elemX = $elemX;

        return $this;
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
}
