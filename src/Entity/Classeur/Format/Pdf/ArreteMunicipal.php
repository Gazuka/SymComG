<?php

namespace App\Entity\Classeur\Format\Pdf;

use App\Entity\composant;
use App\SuperEntity\Format;
use App\SuperEntity\Support;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Classeur\Support\Pdf;
use App\Repository\Classeur\Format\Pdf\ArreteMunicipalRepository;

/**
 * @ORM\Entity(repositoryClass=ArreteMunicipalRepository::class)
 * @ORM\Table(name="media_format_pdf__arrete_municipal")
 */
class ArreteMunicipal extends Format
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datefin;

    /**
     * @ORM\OneToOne(targetEntity=Pdf::class, inversedBy="arreteMunicipal", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $support;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datedebut;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(?\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

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

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(?\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }
}
