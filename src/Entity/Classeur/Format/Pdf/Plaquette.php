<?php

namespace App\Entity\Classeur\Format\Pdf;

use App\SuperEntity\Format;
use App\SuperEntity\Support;
use App\Entity\Classeur\Support\Pdf;
use App\Repository\Classeur\Format\Pdf\PlaquetteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaquetteRepository::class)
 */
class Plaquette extends Format
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
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity=Pdf::class, inversedBy="plaquette", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $support;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSupport(): ?Pdf
    {
        return $this->support;
    }

    public function setSupport(Support $support): Format
    {
        $this->support = $support;

        return $this;
    }
}
