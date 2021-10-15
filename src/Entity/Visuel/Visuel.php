<?php

namespace App\Entity\Visuel;

use App\Entity\Agenda\Horaire;
use App\Entity\Article\Article;
use App\Entity\Organisme\Organisme;
use App\Entity\Visuel\Element\ElemZone;
use App\Repository\Visuel\VisuelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisuelRepository::class)
 */
class Visuel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Article::class, mappedBy="visuel", cascade={"persist", "remove"})
     */
    private $article;

    private $parent = null;
    private $parentType = null;

    /**
     * @ORM\OneToOne(targetEntity=Article::class, mappedBy="annexe", cascade={"persist", "remove"})
     */
    private $article_annexe;

    /**
     * @ORM\OneToOne(targetEntity=ElemZone::class, inversedBy="visuel", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $elemZone;

    /**
     * @ORM\OneToOne(targetEntity=Organisme::class, mappedBy="visuel", cascade={"persist", "remove"})
     */
    private $organisme;

    /**
     * @ORM\OneToOne(targetEntity=Horaire::class, mappedBy="visuel", cascade={"persist", "remove"})
     */
    private $horaire;

    public function __construct()
    {
        $this->elemZone = new ElemZone(0);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(Article $article): self
    {
        // set the owning side of the relation if necessary
        if ($article->getVisuel() !== $this) {
            $article->setVisuel($this);
        }

        $this->article = $article;

        return $this;
    }

    public function getParent()
    {
        if($this->parent == null)
        {
            if($this->article != null)
            {
                $this->parent = $this->article;
                $this->parentType = 'article';
            }         
            else
            {
                if($this->article_annexe != null)
                {
                    $this->parent = $this->article_annexe;
                    $this->parentType = 'article';
                }  
                else
                {
                    if($this->organisme != null)
                    {
                        $this->parent = $this->organisme;
                        $this->parentType = 'organisme';
                    }
                }
            }   
        }
        return $this->parent;
    }
    public function getParentType()
    {
        if($this->parentType == null)
        {
            $this->getParent();
        }
        return $this->parentType;
    }

    public function getApercu()
    {
        $apercu = null;
        $apercu = $this->elemZone->getApercu($apercu);
        return $apercu;
    }

    public function getArticleAnnexe(): ?Article
    {
        return $this->article_annexe;
    }

    public function setArticleAnnexe(?Article $article_annexe): self
    {
        // unset the owning side of the relation if necessary
        if ($article_annexe === null && $this->article_annexe !== null) {
            $this->article_annexe->setAnnexe(null);
        }

        // set the owning side of the relation if necessary
        if ($article_annexe !== null && $article_annexe->getAnnexe() !== $this) {
            $article_annexe->setAnnexe($this);
        }

        $this->article_annexe = $article_annexe;

        return $this;
    }

    public function getElemZone(): ?ElemZone
    {
        return $this->elemZone;
    }

    public function setElemZone(ElemZone $elemZone): self
    {
        $this->elemZone = $elemZone;

        return $this;
    }

    public function getOrganisme(): ?Organisme
    {
        return $this->organisme;
    }

    public function setOrganisme(?Organisme $organisme): self
    {
        // unset the owning side of the relation if necessary
        if ($organisme === null && $this->organisme !== null) {
            $this->organisme->setVisuel(null);
        }

        // set the owning side of the relation if necessary
        if ($organisme !== null && $organisme->getVisuel() !== $this) {
            $organisme->setVisuel($this);
        }

        $this->organisme = $organisme;

        return $this;
    }

    public function getHoraire(): ?Horaire
    {
        return $this->horaire;
    }

    public function setHoraire(?Horaire $horaire): self
    {
        // unset the owning side of the relation if necessary
        if ($horaire === null && $this->horaire !== null) {
            $this->horaire->setVisuel(null);
        }

        // set the owning side of the relation if necessary
        if ($horaire !== null && $horaire->getVisuel() !== $this) {
            $horaire->setVisuel($this);
        }

        $this->horaire = $horaire;

        return $this;
    }
}
