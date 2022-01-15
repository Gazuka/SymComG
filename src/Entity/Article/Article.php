<?php

namespace App\Entity\Article;

use App\Entity\Agenda\Evenement;
use App\Entity\Architecture\Page;
use App\Entity\Classeur\Classeur;
use App\Entity\Visuel\Visuel;
use App\Repository\Article\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
    private $titre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateModification;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDebutPublication;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateFinPublication;

    /**
     * @ORM\OneToOne(targetEntity=Visuel::class, inversedBy="article", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $visuel;

    /**
     * @ORM\ManyToMany(targetEntity=Page::class, mappedBy="articles")
     */
    private $pages;

    /**
     * @ORM\OneToOne(targetEntity=Visuel::class, inversedBy="article_annexe", cascade={"persist", "remove"})
     */
    private $annexe;

    /**
     * @ORM\ManyToMany(targetEntity=Classeur::class, inversedBy="articles")
     */
    private $classeurs;

    /**
     * @ORM\OneToMany(targetEntity=Evenement::class, mappedBy="articlePrincipal")
     */
    private $evenementsPrincipaux;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, mappedBy="ArticlesSecondaires")
     */
    private $evenementsSecondaires;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actualite;

    /**
     * @ORM\Column(type="boolean")
     */
    private $invisible;

    public function __construct()
    {
        $this->dateCreation = new \DateTime('now');
        $this->dateModification = new \DateTime('now');
        $this->visuel = new Visuel();
        $this->pages = new ArrayCollection();
        $this->classeurs = new ArrayCollection();
        $this->evenementsPrincipaux = new ArrayCollection();
        $this->evenementsSecondaires = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->dateModification;
    }

    public function setDateModification(\DateTimeInterface $dateModification): self
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    public function getDateDebutPublication(): ?\DateTimeInterface
    {
        return $this->dateDebutPublication;
    }

    public function setDateDebutPublication(?\DateTimeInterface $dateDebutPublication): self
    {
        $this->dateDebutPublication = $dateDebutPublication;

        return $this;
    }

    public function getDateFinPublication(): ?\DateTimeInterface
    {
        return $this->dateFinPublication;
    }

    public function setDateFinPublication(?\DateTimeInterface $dateFinPublication): self
    {
        $this->dateFinPublication = $dateFinPublication;

        return $this;
    }

    public function getVisuel(): ?Visuel
    {
        return $this->visuel;
    }

    public function setVisuel(Visuel $visuel): self
    {
        $this->visuel = $visuel;

        return $this;
    }

    /**
     * @return Collection|Page[]
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->addArticle($this);
        }

        return $this;
    }

    public function removePage(Page $page): self
    {
        if ($this->pages->removeElement($page)) {
            $page->removeArticle($this);
        }

        return $this;
    }

    public function getAnnexe(): ?Visuel
    {
        return $this->annexe;
    }

    public function setAnnexe(?Visuel $annexe): self
    {
        $this->annexe = $annexe;

        return $this;
    }

    public function testSiAssociationLiee()
    {
        $associationLiee = false;
        if($this->annexe != null)
        {
            if($this->annexe->getElemZone()->testSiAssociationLiee() == true)
            {
                $associationLiee = true;
            }
        }        
        return $associationLiee;
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
        }

        return $this;
    }

    public function removeClasseur(Classeur $classeur): self
    {
        $this->classeurs->removeElement($classeur);

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenementsPrincipaux(): Collection
    {
        return $this->evenementsPrincipaux;
    }

    public function addEvenementsPrincipaux(Evenement $evenementsPrincipaux): self
    {
        if (!$this->evenementsPrincipaux->contains($evenementsPrincipaux)) {
            $this->evenementsPrincipaux[] = $evenementsPrincipaux;
            $evenementsPrincipaux->setArticlePrincipal($this);
        }

        return $this;
    }

    public function removeEvenementsPrincipaux(Evenement $evenementsPrincipaux): self
    {
        if ($this->evenementsPrincipaux->removeElement($evenementsPrincipaux)) {
            // set the owning side to null (unless already changed)
            if ($evenementsPrincipaux->getArticlePrincipal() === $this) {
                $evenementsPrincipaux->setArticlePrincipal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenementsSecondaires(): Collection
    {
        return $this->evenementsSecondaires;
    }

    public function addEvenementsSecondaire(Evenement $evenementsSecondaire): self
    {
        if (!$this->evenementsSecondaires->contains($evenementsSecondaire)) {
            $this->evenementsSecondaires[] = $evenementsSecondaire;
            $evenementsSecondaire->addArticlesSecondaire($this);
        }

        return $this;
    }

    public function removeEvenementsSecondaire(Evenement $evenementsSecondaire): self
    {
        if ($this->evenementsSecondaires->removeElement($evenementsSecondaire)) {
            $evenementsSecondaire->removeArticlesSecondaire($this);
        }

        return $this;
    }

    public function getActualite(): ?bool
    {
        return $this->actualite;
    }

    public function setActualite(bool $actualite): self
    {
        $this->actualite = $actualite;

        return $this;
    }

    public function getInvisible(): ?bool
    {
        return $this->invisible;
    }

    public function setInvisible(bool $invisible): self
    {
        $this->invisible = $invisible;

        return $this;
    }
}
