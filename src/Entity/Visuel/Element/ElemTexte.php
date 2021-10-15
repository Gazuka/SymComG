<?php

namespace App\Entity\Visuel\Element;

use App\Entity\Visuel\ElemX;
use App\SuperEntity\Element;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Visuel\Element\ElemTexteRepository;

/**
 * @ORM\Entity(repositoryClass=ElemTexteRepository::class)
 */
class ElemTexte extends Element
{
    public $nomClasse = 'texte';

    /**
     * @ORM\OneToOne(targetEntity=ElemX::class, inversedBy="elemTexte", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $elemX;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $html;

    public function getElemX(): ?ElemX
    {
        return $this->elemX;
    }

    public function setElemX(ElemX $elemX): self
    {
        $this->elemX = $elemX;

        return $this;
    }

    public function getHtml(): ?string
    {
        return $this->html;
    }

    public function setHtml(?string $html): self
    {
        $this->html = $html;

        return $this;
    }

    public function getApercu($apercu)
    {
        if($apercu == null)
        {
            $apercu = $this->html;
        }
        return $apercu;
    }
}
