<?php

namespace App\Entity\Classeur\Format\Image;

use App\Entity\Classeur\Support\Image;
use App\SuperEntity\Format;
use App\SuperEntity\Support;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AfficheRepository;

/**
 * @ORM\Entity(repositoryClass=AfficheRepository::class)
 * @ORM\Table(name="media_format_image__affiche")
 */
class Affiche extends Format
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datefin;

    /**
     * @ORM\OneToOne(targetEntity=image::class, inversedBy="affiche", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $support;

    public function setSupport(Support $support): Format
    {
        $this->support = $support;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
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

    public function getSupport(): ?Image
    {
        return $this->support;
    }
}