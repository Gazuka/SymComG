<?php

namespace App\Entity\Organisme;

use App\Entity\Organisme\Organisme;
use App\SuperEntity\Structure;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\PrePersist;
use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 * @ORM\Table(name="organisme__entreprise")
 * @ORM\HasLifecycleCallbacks()
 */
class Entreprise extends Structure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Organisme::class, inversedBy="entreprise", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisme;

    /**
     * @ORM\ManyToMany(targetEntity=EnumEntrepriseType::class, inversedBy="entreprise", cascade={"persist"})
     */
    private $types;

    public function __construct()
    {
        parent::__construct();
        $this->types = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|EnumEntrepriseType[]
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

    public function addType(EnumEntrepriseType $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
            $type->addEntreprise($this);
        }

        return $this;
    }

    public function removeType(EnumEntrepriseType $type): self
    {
        if ($this->types->removeElement($type)) {
            $type->removeEntreprise($this);
        }

        return $this;
    }
}
