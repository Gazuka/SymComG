<?php

namespace App\Entity\Classeur;

use App\Entity\Classeur\Media;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Classeur\Classeur;
use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 * @ORM\Table(name="classeur__document")
 */
class Document
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Media::class, mappedBy="document", cascade={"persist", "remove"})
     */
    private $media;

    /**
     * @ORM\ManyToMany(targetEntity=Classeur::class, mappedBy="documents")
     */
    private $classeurs;

    public function __construct()
    {
        $this->classeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedia(): ?Media
    {
        return $this->media;
    }

    public function setMedia(?Media $media): self
    {
        // unset the owning side of the relation if necessary
        if ($media === null && $this->media !== null) {
            $this->media->setDocument(null);
        }

        // set the owning side of the relation if necessary
        if ($media !== null && $media->getDocument() !== $this) {
            $media->setDocument($this);
        }

        $this->media = $media;

        return $this;
    }

    /**
     * @return Collection|Classeur[]
     */
    public function getClasseurs(): Collection
    {
        return $this->classeurs;
    }

    public function addClasseur(Classeur $classeur): self
    {
        if (!$this->classeurs->contains($classeur)) {
            $this->classeurs[] = $classeur;
            $classeur->addDocument($this);
        }

        return $this;
    }

    public function removeClasseur(Classeur $classeur): self
    {
        if ($this->classeurs->removeElement($classeur)) {
            $classeur->removeDocument($this);
        }

        return $this;
    }
}
