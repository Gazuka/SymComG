<?php

namespace App\Entity\Organisme;

use App\SuperEntity\Structure;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Organisme\Organisme;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\PrePersist;
use App\Entity\Organisme\Association;
use App\Repository\AssociationRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AssociationRepository::class)
 * @ORM\Table(name="organisme__association")
 * @ORM\HasLifecycleCallbacks()
 */
class Association extends Structure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
    */
    private $sigle;

    /**
     * @ORM\OneToOne(targetEntity=Organisme::class, inversedBy="association", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisme;

    /**
     * @ORM\ManyToMany(targetEntity=EnumAssociationType::class, inversedBy="association", cascade={"persist"})
     */
    private $types;

    /**
     * @ORM\OneToMany(targetEntity=AssociationGroupe::class, mappedBy="association", orphanRemoval=true)
     */
    private $groupes;

    public function __construct()
    {
        parent::__construct();
        $this->types = new ArrayCollection();
        $this->groupes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(?string $sigle): self
    {
        $this->sigle = $sigle;
        return $this;
    }

    public function getOrganisme(): ?Organisme
    {
        return $this->organisme;
    }

    public function setOrganisme(Organisme $organisme): Structure
    {
        $this->organisme = $organisme;

        return $this;
    }

    /**
     * @return Collection|EnumAssociationType[]
     */
    public function getTypes(): Collection
    {
        $tableauDesTypes = $this->types;
        foreach($this->types as $type)
        {
            $parent = $type->getParent();
            if($parent != null)
            {
                $tableauDesTypes->removeElement($parent);
            }
        }
        return $tableauDesTypes;
    }

    public function addType(EnumAssociationType $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
            $type->addAssociation($this);
        }

        return $this;
    }

    public function removeType(EnumAssociationType $type): self
    {
        if ($this->types->removeElement($type)) {
            $type->removeAssociation($this);
        }

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
            $groupe->setAssociation($this);
        }

        return $this;
    }

    public function removeGroupe(AssociationGroupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getAssociation() === $this) {
                $groupe->setAssociation(null);
            }
        }

        return $this;
    }
}
