<?php

namespace App\SuperEntity;

use App\Entity\Visuel\ElemX;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Visuel\Element\ElemZone;
use App\Repository\Visuel\ElementRepository;

/**
 * @ORM\Entity(repositoryClass=ElementRepository::class)
 */
abstract class Element
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function __construct()
    {
        $this->setElemX(new ElemX());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClasse(): string
    {
        return $this->nomClasse;
    }

    public function getApercu($apercu)
    {
        return $apercu;
    }
}