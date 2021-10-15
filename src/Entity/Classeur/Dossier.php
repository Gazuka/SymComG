<?php

namespace App\Entity\Classeur;

use App\Entity\Classeur\Fichier;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\PrePersist;
use App\Repository\DossierRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Filesystem\Filesystem;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=DossierRepository::class)
 * @ORM\Table(name="media__dossier")
 * @ORM\HasLifecycleCallbacks()
 */
class Dossier
{
    const DOSSIER_RACINE = 'medias';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Dossier::class, inversedBy="enfants")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Dossier::class, mappedBy="parent", cascade={"persist", "remove"})
     */
    private $enfants;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptif;

    /**
     * @ORM\OneToMany(targetEntity=Fichier::class, mappedBy="dossier", orphanRemoval=true)
     */
    private $fichiers;

    public function __construct()
    {
        $this->enfants = new ArrayCollection();
        $this->fichiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getEnfants(): Collection
    {
        return $this->enfants;
    }

    public function addEnfant(self $enfant): self
    {
        if (!$this->enfants->contains($enfant)) {
            $this->enfants[] = $enfant;
            $enfant->setParent($this);
        }

        return $this;
    }

    public function removeEnfant(self $enfant): self
    {
        if ($this->enfants->removeElement($enfant)) {
            // set the owning side to null (unless already changed)
            if ($enfant->getParent() === $this) {
                $enfant->setParent(null);
            }
        }

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(?string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * @return Collection|Fichier[]
     */
    public function getFichiers(): Collection
    {
        return $this->fichiers;
    }

    public function addFichier(Fichier $fichier): self
    {
        if (!$this->fichiers->contains($fichier)) {
            $this->fichiers[] = $fichier;
            $fichier->setDossier($this);
        }

        return $this;
    }

    public function removeFichier(Fichier $fichier): self
    {
        if ($this->fichiers->removeElement($fichier)) {
            // set the owning side to null (unless already changed)
            if ($fichier->getDossier() === $this) {
                $fichier->setDossier(null);
            }
        }

        return $this;
    }

    /** Permet d'initialiser le slug
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeSlug()
    {
        if(empty($this->slug))
        {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->titre);
        }
    }

    public function getChemin()
    {
        $chemin = '';
        if($this->parent != null)
        {
            $chemin .= $this->parent->getChemin();
        }
        $this->initializeSlug();
        $chemin .= $this->slug."/";
        return strtolower($chemin);
    }

    public function getCheminComplet()
    {
        // $current_dir_path = getcwd();
        return self::DOSSIER_RACINE.'/'.$this->getChemin();
    }

    public function creerDossierPhysique()
    {
        $filesystem = new Filesystem();
        $current_dir_path = getcwd();
        $filesystem->mkdir($current_dir_path.'/'.self::DOSSIER_RACINE.'/'.$this->getChemin());
    }

    public function scannerDossier()
    {
        $scan = scandir($this->getCheminComplet());
        return $scan;
    }
}
