<?php

namespace App\Entity\Organisme;

use App\Repository\EnumAssociationTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnumAssociationTypeRepository::class)
 * @ORM\Table(name="organisme__enum_association_type")
 */
class EnumAssociationType
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
     * @ORM\ManyToOne(targetEntity=EnumAssociationType::class, inversedBy="enfants")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=EnumAssociationType::class, mappedBy="parent")
     */
    private $enfants;

    /**
     * @ORM\ManyToMany(targetEntity=Association::class, mappedBy="types")
     */
    private $association;

    /**
     * @ORM\ManyToMany(targetEntity=AssociationGroupe::class, mappedBy="types")
     */
    private $groupes;

    public function __construct()
    {
        $this->enfants = new ArrayCollection();
        $this->association = new ArrayCollection();
        $this->groupes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNomComplet();
    }

    public function getNomComplet()
    {
        $nomComplet = '';
        if($this->parent != null)
        {
            $nomComplet .= $this->parent->getNomComplet();
            $nomComplet .= " > ";
        }
        return $nomComplet.$this->nom;
    }

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

    /**
     * @return Collection|Association[]
     */
    public function getAssociation(): Collection
    {
        return $this->association;
    }

    public function addAssociation(Association $association): self
    {
        if (!$this->association->contains($association)) {
            $this->association[] = $association;
        }

        return $this;
    }

    public function removeAssociation(Association $association): self
    {
        $this->association->removeElement($association);

        return $this;
    }

    /**
     * @return Collection|AssociationGroupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(AssociationGroupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addType($this);
        }

        return $this;
    }

    public function removeGroupe(AssociationGroupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            $groupe->removeType($this);
        }

        return $this;
    }
}
