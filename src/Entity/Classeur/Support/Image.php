<?php

namespace App\Entity\Classeur\Support;

use App\Entity\Classeur\Media;
use App\SuperEntity\Support;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Classeur\Format\Image\Icone;
use App\Entity\Classeur\Format\Image\Photo;
use App\Entity\Classeur\Format\Image\Affiche;
use App\Repository\ImageRepository;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @ORM\Table(name="media_support__image")
 */
class Image extends Support
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Media::class, inversedBy="image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $media;

    /**
     * @ORM\OneToOne(targetEntity=Affiche::class, mappedBy="support", orphanRemoval=true)
     */
    private $affiche;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $alt;

    /**
     * @ORM\OneToOne(targetEntity=Photo::class, mappedBy="support", cascade={"persist", "remove"})
     */
    private $photo;

    /**
     * @ORM\OneToOne(targetEntity=Icone::class, mappedBy="support", cascade={"persist", "remove"})
     */
    private $icone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedia(): ?Media
    {
        return $this->media;
    }

    public function setMedia(Media $media): self
    {
        $this->media = $media;

        return $this;
    }

    public function getFormatName(): string
    {
        if($this->affiche != null)
        {
            $this->formatName = 'affiche';
            $this->format = $this->affiche;
        }
        if($this->photo != null)
        {
            $this->formatName = 'photo';
            $this->format = $this->photo;
        }
        if($this->icone != null)
        {
            $this->formatName = 'icone';
            $this->format = $this->icone;
        }
        //Par défaut on met inconnu
        if($this->formatName == null)
        {
            $this->formatName = 'inconnu';
            $this->format = null;
        }
        return $this->formatName;
    }

    

    // public function getAffiche(): ?Affiche
    // {
    //     return $this->affiche;
    // }

    // public function setAffiche(Affiche $affiche): self
    // {
    //     // set the owning side of the relation if necessary
    //     if ($affiche->getImage() !== $this) {
    //         $affiche->setImage($this);
    //     }

    //     $this->affiche = $affiche;

    //     return $this;
    // }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }

    public function setPhoto(Photo $photo): self
    {
        // set the owning side of the relation if necessary
        if ($photo->getSupport() !== $this) {
            $photo->setSupport($this);
        }

        $this->photo = $photo;

        return $this;
    }

    public function getIcone(): ?Icone
    {
        return $this->icone;
    }

    public function setIcone(Icone $icone): self
    {
        // set the owning side of the relation if necessary
        if ($icone->getSupport() !== $this) {
            $icone->setSupport($this);
        }

        $this->icone = $icone;

        return $this;
    }
}
