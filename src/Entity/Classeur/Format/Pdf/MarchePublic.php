<?php

namespace App\Entity\Classeur\Format\Pdf;

use App\SuperEntity\Format;
use App\SuperEntity\Support;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Classeur\Support\Pdf;
use App\Repository\Classeur\Format\Pdf\MarchePublicRepository;

/**
 * @ORM\Entity(repositoryClass=MarchePublicRepository::class)
 * @ORM\Table(name="media_format_pdf__marche_public")
 */
class MarchePublic extends Format
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
    private $datedebut;

    /**
     * @ORM\Column(type="date")
     */
    private $datefin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\OneToOne(targetEntity=Pdf::class, inversedBy="marchePublic", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $support;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

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
