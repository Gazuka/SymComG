<?php

namespace App\Entity\Classeur\Format\Image;

use App\Entity\Classeur\Support\Image;
use App\SuperEntity\Format;
use App\SuperEntity\Support;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PhotoRepository;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 * @ORM\Table(name="media_format_image__photo")
 */
class Photo extends Format
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
     * @ORM\OneToOne(targetEntity=Image::class, inversedBy="photo", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $support;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $actualite;

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

    public function getSupport(): ?Image
    {
        return $this->support;
    }

    public function setSupport(Support $support): Format
    {
        $this->support = $support;

        return $this;
    }

    public function getActualite(): ?bool
    {
        return $this->actualite;
    }

    public function setActualite(?bool $actualite): self
    {
        $this->actualite = $actualite;

        return $this;
    }
}
