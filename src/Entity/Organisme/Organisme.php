<?php

namespace App\Entity\Organisme;

use DateTime;
use App\Entity\Lieu;
use ReflectionClass;
use App\Entity\Menu\Lien;
use App\Entity\Poste\Poste;
use App\Entity\Visuel\Visuel;
use App\Entity\Agenda\Horaire;
use App\SuperEntity\Structure;
use App\Entity\Agenda\Evenement;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Classeur\Classeur;
use App\Entity\Organisme\Service;
use App\Entity\Organisme\Entreprise;
use App\Entity\Organisme\Association;
use App\Entity\CarteVisite\CarteVisite;
use App\Repository\OrganismeRepository;
use Doctrine\Common\Collections\Collection;
use App\Entity\Visuel\Element\ElemOrganisme;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=OrganismeRepository::class)
 * @ORM\Table(name="organisme__organisme")
 */
class Organisme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    private $typeStructure;
    private $structure;
    private $evenementsActifs = null;

    /**
     * @ORM\OneToOne(targetEntity=Association::class, mappedBy="organisme", cascade={"persist", "remove"})
     */
    private $association;

    /**
     * @ORM\OneToOne(targetEntity=Service::class, mappedBy="organisme", cascade={"persist", "remove"})
     */
    private $service;

    /**
     * @ORM\OneToOne(targetEntity=Entreprise::class, mappedBy="organisme", cascade={"persist", "remove"})
     */
    private $entreprise;

    /**
     * @ORM\OneToOne(targetEntity=CarteVisite::class, mappedBy="organisme", cascade={"persist", "remove"})
     */
    private $carteVisite;

    /**
     * @ORM\ManyToMany(targetEntity=Classeur::class, mappedBy="organisme", cascade={"persist", "remove"})
     */
    private $classeurs;

    /**
     * @ORM\OneToMany(targetEntity=Poste::class, mappedBy="organisme", orphanRemoval=true)
     */
    private $postes;

    /**
     * @ORM\ManyToMany(targetEntity=Lien::class, inversedBy="organismes", cascade={"persist", "remove"})
     */
    private $liens;

    /**
     * @ORM\OneToMany(targetEntity=ElemOrganisme::class, mappedBy="organisme", orphanRemoval=true)
     */
    private $elemOrganismes;

    /**
     * @ORM\OneToOne(targetEntity=Visuel::class, inversedBy="organisme", cascade={"persist", "remove"})
     */
    private $visuel;

    /**
     * @ORM\OneToOne(targetEntity=Horaire::class, inversedBy="organisme", cascade={"persist", "remove"})
     */
    private $horaire;

    /**
     * @ORM\OneToOne(targetEntity=Lieu::class, mappedBy="organisme", cascade={"persist", "remove"})
     */
    private $lieu;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, mappedBy="organisateurs")
     * @ORM\OrderBy({"date" = "ASC"})
     */
    private $evenements;

    // /**
    //  * @ORM\OneToOne(targetEntity=ElemOrganisme::class, mappedBy="organisme", cascade={"persist", "remove"})
    //  */
    // private $elemOrganisme;

    public function __construct()
    {
        $this->classeurs = new ArrayCollection();
        $this->postes = new ArrayCollection();
        $this->liens = new ArrayCollection();
        $this->elemOrganismes = new ArrayCollection();
        $this->evenements = new ArrayCollection();
    }

    public function __toString()
    {
        return strval($this->getStructure());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Permet de récupérer le type de structure
     */
    public function getTypeStructure(): string
    {
        $structuresPossibles = [$this->association, $this->service, $this->entreprise];
        foreach($structuresPossibles as $structurePossible)
        {
            if($structurePossible != null)
            {
                $this->typeStructure =  strtolower((new \ReflectionClass($structurePossible))->getShortName());
                $this->structure = $structurePossible;
            }   
        }          
        return $this->typeStructure;
    }

    /**
     * Permet de récupérer la structure de l'organisme (une association, une entreprise, un service...)
     */
    public function getStructure(): ?Structure
    {
        if($this->structure == null)
        {
            $this->getTypeStructure();
        }
        return $this->structure;
    }

    public function getAssociation(): ?Association
    {
        return $this->association;
    }

    public function setAssociation(Association $association): self
    {
        // set the owning side of the relation if necessary
        if ($association->getOrganisme() !== $this) {
            $association->setOrganisme($this);
        }

        $this->association = $association;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(Service $service): self
    {
        // set the owning side of the relation if necessary
        if ($service->getOrganisme() !== $this) {
            $service->setOrganisme($this);
        }

        $this->service = $service;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(Entreprise $entreprise): self
    {
        // set the owning side of the relation if necessary
        if ($entreprise->getOrganisme() !== $this) {
            $entreprise->setOrganisme($this);
        }

        $this->entreprise = $entreprise;

        return $this;
    }

    public function getCarteVisite(): ?CarteVisite
    {
        return $this->carteVisite;
    }

    public function setCarteVisite(?CarteVisite $carteVisite): self
    {
        // unset the owning side of the relation if necessary
        if ($carteVisite === null && $this->carteVisite !== null) {
            $this->carteVisite->setOrganisme(null);
        }

        // set the owning side of the relation if necessary
        if ($carteVisite !== null && $carteVisite->getOrganisme() !== $this) {
            $carteVisite->setOrganisme($this);
        }

        $this->carteVisite = $carteVisite;

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
            $classeur->addOrganisme($this);
        }

        return $this;
    }

    public function removeClasseur(Classeur $classeur): self
    {
        if ($this->classeurs->removeElement($classeur)) {
            $classeur->removeOrganisme($this);
        }

        return $this;
    }

    /**
     * @return Collection|Poste[]
     */
    public function getPostes(): Collection
    {
        return $this->postes;
    }

    public function addPoste(Poste $poste): self
    {
        if (!$this->postes->contains($poste)) {
            $this->postes[] = $poste;
            $poste->setOrganisme($this);
        }

        return $this;
    }

    public function removePoste(Poste $poste): self
    {
        if ($this->postes->removeElement($poste)) {
            // set the owning side to null (unless already changed)
            if ($poste->getOrganisme() === $this) {
                $poste->setOrganisme(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lien[]
     */
    public function getLiens(): Collection
    {
        return $this->liens;
    }

    public function addLien(Lien $lien): self
    {
        if (!$this->liens->contains($lien)) {
            $this->liens[] = $lien;
        }

        return $this;
    }

    public function removeLien(Lien $lien): self
    {
        $this->liens->removeElement($lien);

        return $this;
    }

    /**
     * @return Collection|ElemOrganisme[]
     */
    public function getElemOrganismes(): Collection
    {
        return $this->elemOrganismes;
    }

    public function addElemOrganisme(ElemOrganisme $elemOrganisme): self
    {
        if (!$this->elemOrganismes->contains($elemOrganisme)) {
            $this->elemOrganismes[] = $elemOrganisme;
            $elemOrganisme->setOrganisme($this);
        }

        return $this;
    }

    public function removeElemOrganisme(ElemOrganisme $elemOrganisme): self
    {
        if ($this->elemOrganismes->removeElement($elemOrganisme)) {
            // set the owning side to null (unless already changed)
            if ($elemOrganisme->getOrganisme() === $this) {
                $elemOrganisme->setOrganisme(null);
            }
        }

        return $this;
    }

    public function getVisuel(): ?Visuel
    {
        return $this->visuel;
    }

    public function setVisuel(?Visuel $visuel): self
    {
        $this->visuel = $visuel;

        return $this;
    }

    public function testSiAssociationLiee()
    {
        $associationLiee = false;
        if($this->getTypeStructure() == 'association')
        {
            $associationLiee = true;
        }
        return $associationLiee;
    }

    public function getHoraire(): ?Horaire
    {
        return $this->horaire;
    }

    public function setHoraire(?Horaire $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }

    public function getLieu(): ?Lieu
    {
        return $this->lieu;
    }

    public function setLieu(?Lieu $lieu): self
    {
        // unset the owning side of the relation if necessary
        if ($lieu === null && $this->lieu !== null) {
            $this->lieu->setOrganisme(null);
        }

        // set the owning side of the relation if necessary
        if ($lieu !== null && $lieu->getOrganisme() !== $this) {
            $lieu->setOrganisme($this);
        }

        $this->lieu = $lieu;

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function getEvenementsActifs(): Array
    {
        if($this->evenementsActifs == null)
        {
            $dateActuelle = new DateTime();
            $this->evenementsActifs = array();
            foreach($this->evenements as $evenement)
            {
                if($evenement->getDate() >= $dateActuelle)
                {
                    array_push($this->evenementsActifs, $evenement);
                }
            }
        }
        return $this->evenementsActifs;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->addOrganisateur($this);
        }
        $this->evenementsActifs = null;

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->evenements->removeElement($evenement)) {
            $evenement->removeOrganisateur($this);
        }
        $this->evenementsActifs = null;

        return $this;
    }
}