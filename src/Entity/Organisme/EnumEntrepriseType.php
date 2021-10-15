<?php

namespace App\Entity\Organisme;

use App\Repository\EnumEntrepriseTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnumEntrepriseTypeRepository::class)
 * @ORM\Table(name="organisme__enum_entreprise_type")
 */
class EnumEntrepriseType
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
     * @ORM\ManyToOne(targetEntity=EnumEntrepriseType::class, inversedBy="enfants")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=EnumEntrepriseType::class, mappedBy="parent")
     */
    private $enfants;

    /**
     * @ORM\ManyToMany(targetEntity=Entreprise::class, mappedBy="types")
     */
    private $entreprise;

    public function __construct()
    {
        $this->enfants = new ArrayCollection();
        $this->entreprise = new ArrayCollection();
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
     * @return Collection|Entreprise[]
     */
    public function getEntreprise(): Collection
    {
        return $this->entreprise;
    }

    public function addEntreprise(Entreprise $entreprise): self
    {
        if (!$this->entreprise->contains($entreprise)) {
            $this->entreprise[] = $entreprise;
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): self
    {
        $this->entreprise->removeElement($entreprise);

        return $this;
    }
}
