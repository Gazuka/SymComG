<?php

namespace App\Entity\Visuel\Element;

use App\Entity\Organisme\Organisme;
use App\SuperEntity\Element;
use App\Entity\Visuel\ElemX;
use App\Repository\Visuel\Element\ElemOrganismeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ElemOrganismeRepository::class)
 */
class ElemOrganisme extends Element
{
    public $nomClasse = 'elemOrganisme';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity=ElemX::class, inversedBy="elemOrganisme", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $elemX;

    /**
     * @ORM\ManyToOne(targetEntity=Organisme::class, inversedBy="elemOrganismes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisme;

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

    public function getOrganisme(): ?Organisme
    {
        return $this->organisme;
    }

    public function setOrganisme(?Organisme $organisme): self
    {
        $this->organisme = $organisme;

        return $this;
    }

    public function testSiAssociationLiee()
    {
        $associationLiee = false;
        if($this->organisme->testSiAssociationLiee() == true)
        {
            $associationLiee = true;
        }
        return $associationLiee;
    }
}
