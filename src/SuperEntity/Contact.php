<?php

namespace App\SuperEntity;

use App\Entity\CarteVisite\CarteVisite;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
abstract class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $prive;

    public function getPrive(): ?bool
    {
        return $this->prive;
    }

    public function setPrive(bool $prive): self
    {
        $this->prive = $prive;
        return $this;
    }

    //Force à créer un lien entre la sous contact et CarteVisite
    abstract public function getCarteVisite(): ?CarteVisite;
    abstract public function setCarteVisite(CarteVisite $carteVisite): self;
}
