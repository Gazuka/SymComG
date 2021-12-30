<?php

namespace App\Entity\Agenda;

use App\Entity\Article\Article;
use App\Entity\Classeur\Classeur;
use App\Entity\Lieu;
use App\Entity\Organisme\Organisme;
use App\Entity\TypePublic;
use App\Repository\Agenda\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
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
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureDebut;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureFin;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $majeur;

    /**
     * @ORM\ManyToMany(targetEntity=Lieu::class, inversedBy="evenements")
     */
    private $lieux;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="evenementsPrincipaux", cascade={"persist", "remove"})
     */
    private $articlePrincipal;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, inversedBy="evenementsSecondaires")
     */
    private $ArticlesSecondaires;

    /**
     * @ORM\ManyToMany(targetEntity=Organisme::class, inversedBy="evenements")
     */
    private $organisateurs;

    /**
     * @ORM\ManyToMany(targetEntity=Classeur::class, inversedBy="evenements")
     */
    private $classeurs;

    /**
     * @ORM\ManyToMany(targetEntity=TypePublic::class, inversedBy="evenements")
     */
    private $typesPublics;

    public function __construct()
    {
        $this->lieux = new ArrayCollection();
        $this->ArticlesSecondaires = new ArrayCollection();
        $this->organisateurs = new ArrayCollection();
        $this->classeurs = new ArrayCollection();
        $this->typesPublics = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(?\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(?\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getMajeur(): ?bool
    {
        return $this->majeur;
    }

    public function setMajeur(bool $majeur): self
    {
        $this->majeur = $majeur;

        return $this;
    }

    /**
     * @return Collection|Lieu[]
     */
    public function getLieux(): Collection
    {
        return $this->lieux;
    }

    public function addLieux(Lieu $lieux): self
    {
        if (!$this->lieux->contains($lieux)) {
            $this->lieux[] = $lieux;
        }

        return $this;
    }

    public function removeLieux(Lieu $lieux): self
    {
        $this->lieux->removeElement($lieux);

        return $this;
    }

    public function getArticlePrincipal(): ?Article
    {
        return $this->articlePrincipal;
    }

    public function setArticlePrincipal(?Article $articlePrincipal): self
    {
        $this->articlePrincipal = $articlePrincipal;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticlesSecondaires(): Collection
    {
        return $this->ArticlesSecondaires;
    }

    public function addArticlesSecondaire(Article $articlesSecondaire): self
    {
        if (!$this->ArticlesSecondaires->contains($articlesSecondaire)) {
            $this->ArticlesSecondaires[] = $articlesSecondaire;
        }

        return $this;
    }

    public function removeArticlesSecondaire(Article $articlesSecondaire): self
    {
        $this->ArticlesSecondaires->removeElement($articlesSecondaire);

        return $this;
    }

    /**
     * @return Collection|Organisme[]
     */
    public function getOrganisateurs(): Collection
    {
        return $this->organisateurs;
    }

    public function addOrganisateur(Organisme $organisateur): self
    {
        if (!$this->organisateurs->contains($organisateur)) {
            $this->organisateurs[] = $organisateur;
        }

        return $this;
    }

    public function removeOrganisateur(Organisme $organisateur): self
    {
        $this->organisateurs->removeElement($organisateur);

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
        }

        return $this;
    }

    public function removeClasseur(Classeur $classeur): self
    {
        $this->classeurs->removeElement($classeur);

        return $this;
    }

    /**
     * @return Collection|TypePublic[]
     */
    public function getTypesPublics(): Collection
    {
        return $this->typesPublics;
    }

    public function addTypesPublic(TypePublic $typesPublic): self
    {
        if (!$this->typesPublics->contains($typesPublic)) {
            $this->typesPublics[] = $typesPublic;
        }

        return $this;
    }

    public function removeTypesPublic(TypePublic $typesPublic): self
    {
        $this->typesPublics->removeElement($typesPublic);

        return $this;
    }
}
