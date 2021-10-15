<?php

namespace App\Entity\Classeur;

use Cocur\Slugify\Slugify;
use App\Entity\Classeur\Dossier;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\PrePersist;
use App\Repository\FichierRepository;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

/**
 * @ORM\Entity(repositoryClass=FichierRepository::class)
 * @ORM\Table(name="media__fichier")
 * @ORM\HasLifecycleCallbacks()
 */
class Fichier
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $extension;

    /**
     * @ORM\ManyToOne(targetEntity=Dossier::class, inversedBy="fichiers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dossier;

    /**
     * @ORM\OneToOne(targetEntity=Media::class, inversedBy="fichier", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $media;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getDossier(): ?Dossier
    {
        return $this->dossier;
    }

    public function setDossier(?Dossier $dossier): self
    {
        $this->dossier = $dossier;
        return $this;
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

    /**
     * Permet de récupérer le nom et l'extension d'un fichier à partir de son nom de fichier
     */
    public function decortiqueNom(string $nomFichier): self
    {
        $element = pathinfo($nomFichier);
        $this->nom = $element['filename'];
        $this->extension = strtolower($element['extension']);
        $this->slug = (new \DateTime())->getTimestamp();
        //Ecrit le nom du fichier dans un format correcte pour le serveur
        $slugify = new Slugify();
        rename($this->dossier->getCheminComplet().$this->nom.'.'.$this->extension, $this->dossier->getCheminComplet().$this->getFileName());
        return $this;
    }

    public function getfileName()
    {
        $slugify = new Slugify();
        return $slugify->slugify($this->slug.'_'.$this->nom).'.'.$this->extension;
    }

    public function deplacer($dossier)
    {
        $resultat = false;
        $source = $this->dossier->getCheminComplet();
        $cible = $dossier->getCheminComplet();
        $fileName = $this->getFileName();
        //Déplacement du fichier
        if(rename($source.$fileName, $cible.$fileName))
        {
            //le fichier a été déplacé .. on peut supprimer la source
            // unlink($source.$fileName);
            $this->dossier = $dossier;
            $resultat = true;
        }
        return $resultat;
    }

    public function getChemin()
    {
        $chemin = $this->dossier->getCheminComplet().$this->getFileName();
        return str_replace("\\", "/", $chemin);
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }    
}