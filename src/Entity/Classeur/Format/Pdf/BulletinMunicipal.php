<?php

namespace App\Entity\Classeur\Format\Pdf;

use App\SuperEntity\Format;
use App\SuperEntity\Support;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Classeur\Support\Pdf;
use App\Repository\BulletinMunicipalRepository;

/**
 * @ORM\Entity(repositoryClass=BulletinMunicipalRepository::class)
 * @ORM\Table(name="media_format_pdf__bulletin_municipal")
 */
class BulletinMunicipal extends Format
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
     * @ORM\OneToOne(targetEntity=Pdf::class, inversedBy="bulletinMunicipal", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $support;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $periode;

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

    public function getPeriode(): ?string
    {
        return $this->periode;
    }

    public function setPeriode(string $periode): self
    {
        $this->periode = $periode;

        return $this;
    }
}
