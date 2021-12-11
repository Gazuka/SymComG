<?php

namespace App\Entity\Classeur\Support;

use App\Entity\Classeur\Format\Pdf\ArreteMunicipal;
use App\Entity\Classeur\Format\Pdf\BulletinMunicipal;
use App\Entity\Classeur\Format\Pdf\Deliberation;
use App\Entity\Classeur\Media;
use App\SuperEntity\Support;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PdfRepository;

/**
 * @ORM\Entity(repositoryClass=PdfRepository::class)
 * @ORM\Table(name="media_support__pdf")
 */
class Pdf extends Support
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Media::class, inversedBy="pdf", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $media;

    /**
     * @ORM\OneToOne(targetEntity=BulletinMunicipal::class, mappedBy="support", cascade={"persist", "remove"})
     */
    private $bulletinMunicipal;

    /**
     * @ORM\OneToOne(targetEntity=ArreteMunicipal::class, mappedBy="support", cascade={"persist", "remove"})
     */
    private $arreteMunicipal;

    /**
     * @ORM\OneToOne(targetEntity=Deliberation::class, mappedBy="support", cascade={"persist", "remove"})
     */
    private $deliberation;

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
        if($this->bulletinMunicipal != null)
        {
            $this->formatName = 'bulletin';
            $this->format = $this->bulletinMunicipal;
        }
        if($this->arreteMunicipal != null)
        {
            $this->formatName = 'arrete';
            $this->format = $this->arreteMunicipal;
        }
        if($this->deliberation != null)
        {
            $this->formatName = 'deliberation';
            $this->format = $this->deliberation;
        }
        //Par défaut on met inconnu
        if($this->formatName == null)
        {
            $this->formatName = 'inconnu';
            $this->format = null;
        }
        return $this->formatName;
    }

    public function getFormat()
    {
        $this->getFormatName();
        return $this->format;
    }    


    public function getBulletinMunicipal(): ?BulletinMunicipal
    {
        return $this->bulletinMunicipal;
    }

    public function setBulletinMunicipal(BulletinMunicipal $bulletinMunicipal): self
    {
        // set the owning side of the relation if necessary
        if ($bulletinMunicipal->getSupport() !== $this) {
            $bulletinMunicipal->setSupport($this);
        }

        $this->bulletinMunicipal = $bulletinMunicipal;

        return $this;
    }

    public function getArreteMunicipal(): ?ArreteMunicipal
    {
        return $this->arreteMunicipal;
    }

    public function setArreteMunicipal(ArreteMunicipal $arreteMunicipal): self
    {
        // set the owning side of the relation if necessary
        if ($arreteMunicipal->getSupport() !== $this) {
            $arreteMunicipal->setSupport($this);
        }

        $this->arreteMunicipal = $arreteMunicipal;

        return $this;
    }

    public function getDeliberation(): ?Deliberation
    {
        return $this->deliberation;
    }

    public function setDeliberation(Deliberation $deliberation): self
    {
        // set the owning side of the relation if necessary
        if ($deliberation->getSupport() !== $this) {
            $deliberation->setSupport($this);
        }

        $this->deliberation = $deliberation;

        return $this;
    }
}
