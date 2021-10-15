<?php

namespace App\Entity\Classeur;

use App\Entity\Classeur\Document;
use App\Entity\Classeur\Fichier;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Classeur\Support\Pdf;
use App\Entity\Classeur\Support\Image;
use App\Repository\Classeur\MediaRepository;

/**
 * @ORM\Entity(repositoryClass=MediaRepository::class)
 * @ORM\Table(name="media__media")
 */
class Media
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Fichier::class, mappedBy="media", cascade={"persist", "remove"})
     */
    private $fichier;

    /**
     * @ORM\OneToOne(targetEntity=Pdf::class, mappedBy="media", cascade={"persist", "remove"})
     */
    private $pdf;

    /**
     * @ORM\OneToOne(targetEntity=Document::class, inversedBy="media", cascade={"persist", "remove"})
     */
    private $document;

    /**
     * Nom du support (image, pdf, video...)
     */
    private $supportName;

    /**
     * Retourne l'objet de type support (l'image, le pdf, la video...)
     */
    private $support;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, mappedBy="media", cascade={"persist", "remove"})
     */
    private $image;

    public function getSupportName()
    {
        if($this->pdf != null)
        {
            $this->supportName = 'pdf';
            $this->support = $this->pdf;
        }
        if($this->image != null)
        {
            $this->supportName = 'image';
            $this->support = $this->image;
        }
        //Par défaut on met inconnu
        if($this->supportName == null)
        {
            $this->supportName = 'inconnu';
            $this->support = null;
        }
        return $this->supportName;
    }

    public function getSupport()
    {
        $this->getSupportName();
        return $this->support;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFichier(): ?Fichier
    {
        return $this->fichier;
    }

    public function setFichier(Fichier $fichier): self
    {
        // set the owning side of the relation if necessary
        if ($fichier->getMedia() !== $this) {
            $fichier->setMedia($this);
        }

        $this->fichier = $fichier;

        return $this;
    }

    public function getPdf(): ?Pdf
    {
        return $this->pdf;
    }

    public function setPdf(Pdf $pdf): self
    {
        // set the owning side of the relation if necessary
        if ($pdf->getMedia() !== $this) {
            $pdf->setMedia($this);
        }

        $this->pdf = $pdf;

        return $this;
    }

    public function getDocument(): ?Document
    {
        return $this->document;
    }

    public function setDocument(?Document $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(Image $image): self
    {
        // set the owning side of the relation if necessary
        if ($image->getMedia() !== $this) {
            $image->setMedia($this);
        }

        $this->image = $image;

        return $this;
    }
}
