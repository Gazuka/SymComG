<?php

namespace App\Entity\Agenda;

use App\Entity\Organisme\Organisme;
use App\Entity\Visuel\Visuel;
use App\Repository\Agenda\HoraireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HoraireRepository::class)
 */
class Horaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Visuel::class, inversedBy="horaire", cascade={"persist", "remove"})
     */
    private $visuel;

    /**
     * @ORM\OneToOne(targetEntity=Organisme::class, mappedBy="horaire", cascade={"persist", "remove"})
     */
    private $organisme;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisuel(): ?Visuel
    {
        return $this->visuel;
    }

    public function setVisuel(?Visuel $visuel): self
    {
        $this->visuel = $visuel;

        return $this;
    }

    public function getOrganisme(): ?Organisme
    {
        return $this->organisme;
    }

    public function setOrganisme(?Organisme $organisme): self
    {
        // unset the owning side of the relation if necessary
        if ($organisme === null && $this->organisme !== null) {
            $this->organisme->setHoraire(null);
        }

        // set the owning side of the relation if necessary
        if ($organisme !== null && $organisme->getHoraire() !== $this) {
            $organisme->setHoraire($this);
        }

        $this->organisme = $organisme;

        return $this;
    }
}
