<?php

namespace App\Entity\Classeur;

use App\Entity\Article\Article;
use App\Entity\Profil\Profil;
use App\Entity\Classeur\Media;
use App\Entity\Visuel\Element\ElemDiapo;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Organisme\Organisme;
use App\Repository\ClasseurRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Service\ClasseurService;

/**
 * @ORM\Entity(repositoryClass=ClasseurRepository::class)
 * @ORM\Table(name="classeur__classeur")
 */
class Classeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Document::class, inversedBy="classeurs")
     */
    private $documents;

    /**
     * @ORM\ManyToMany(targetEntity=Organisme::class, inversedBy="classeurs", cascade={"persist"})
     */
    private $organisme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity=EnumClasseurType::class, inversedBy="classeur", cascade={"persist"})
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity=Profil::class, mappedBy="classeurs")
     */
    private $profils;

    /**
     * @ORM\OneToOne(targetEntity=ElemDiapo::class, mappedBy="classeur", cascade={"persist", "remove"})
     */
    private $elemDiapo;

    private $parent;

    private $classeurService;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="classeurs")
     */
    private $articles;

    

    public function getTypesMediasAutorises($nom)
    {
        $classeurService = new ClasseurService();
        return $classeurService->recupAjoutMedia($nom);
    }

    public function getParent()
    {
        if($this->organisme != null)
        {
            $this->parent = $this->organisme;
        }
        return $this->parent;
    }

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->organisme = new ArrayCollection();
        $this->profils = new ArrayCollection();
        $this->articles = new ArrayCollection();        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        $this->documents->removeElement($document);

        return $this;
    }

    /**
     * @return Collection|Organisme[]
     */
    public function getOrganisme(): Collection
    {
        return $this->organisme;
    }

    public function addOrganisme(Organisme $organisme): self
    {
        if (!$this->organisme->contains($organisme)) {
            $this->organisme[] = $organisme;
        }

        return $this;
    }

    public function removeOrganisme(Organisme $organisme): self
    {
        $this->organisme->removeElement($organisme);

        return $this;
    }

    public function setProprietaire(Object $proprietaire)
    {
        $proprietaire->setClasseur($this);
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

    public function getType(): ?EnumClasseurType
    {
        return $this->type;
    }

    public function setType(?EnumClasseurType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Profil[]
     */
    public function getProfils(): Collection
    {
        return $this->profils;
    }

    public function addProfil(Profil $profil): self
    {
        if (!$this->profils->contains($profil)) {
            $this->profils[] = $profil;
            $profil->addClasseur($this);
        }

        return $this;
    }

    public function removeProfil(Profil $profil): self
    {
        if ($this->profils->removeElement($profil)) {
            $profil->removeClasseur($this);
        }

        return $this;
    }

    public function getElemDiapo(): ?ElemDiapo
    {
        return $this->elemDiapo;
    }

    public function setElemDiapo(ElemDiapo $elemDiapo): self
    {
        // set the owning side of the relation if necessary
        if ($elemDiapo->getClasseur() !== $this) {
            $elemDiapo->setClasseur($this);
        }

        $this->elemDiapo = $elemDiapo;

        return $this;
    }

    /**
     * Retourne tous les documents du bon supportName et formatName
     */
    public function filtreParSupport($supportName, $formatName = null)
    {
        $documents = array();
        foreach($this->getDocuments() as $document)
        {
            if($document->getMedia()->getSupportName() == $supportName)
            {
                if($formatName != null)
                {
                    if($document->getMedia()->getSupport()->getFormatName() == $formatName)
                    {
                        array_push($documents, $document);    
                    }
                }
                else
                {
                    array_push($documents, $document);
                }
            }
        }
        return $documents;
    }

    public function filtreAleatoireParSupport($nbr, $supportName, $formatName = null)
    {
        $documentsAleatoires = array();
        $documents = $this->filtreParSupport($supportName, $formatName);
        if($documents != null)
        {
            $cles = array_rand($documents, $nbr);
            if(is_array($cles))
            {
                foreach($cles as $cle)
                {
                    array_push($documentsAleatoires, $documents[$cle]);
                }
            }
            else
            {
                array_push($documentsAleatoires, $documents[$cles]);
            }
        }
        return $documentsAleatoires;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->addClasseur($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            $article->removeClasseur($this);
        }

        return $this;
    }
}
