<?php

namespace App\Entity\Menu;

use App\Entity\Organisme\Organisme;
use App\Repository\Menu\LienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LienRepository::class)
 */
class Lien
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\ManyToMany(targetEntity=Organisme::class, mappedBy="liens")
     */
    private $organismes;

    /**
     * @ORM\OneToOne(targetEntity=Chemin::class, inversedBy="lien", cascade={"persist", "remove"})
     */
    private $chemin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptif;

    /**
     * @ORM\ManyToMany(targetEntity=Menu::class, mappedBy="liens")
     */
    private $menus;

    public function __construct()
    {
        $this->organismes = new ArrayCollection();
        $this->menus = new ArrayCollection();
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|Organisme[]
     */
    public function getOrganismes(): Collection
    {
        return $this->organismes;
    }

    public function addOrganisme(Organisme $organisme): self
    {
        if (!$this->organismes->contains($organisme)) {
            $this->organismes[] = $organisme;
            $organisme->addLien($this);
        }

        return $this;
    }

    public function removeOrganisme(Organisme $organisme): self
    {
        if ($this->organismes->removeElement($organisme)) {
            $organisme->removeLien($this);
        }

        return $this;
    }

    public function getChemin(): ?Chemin
    {
        return $this->chemin;
    }

    public function setChemin(?Chemin $chemin): self
    {
        $this->chemin = $chemin;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * @return Collection|Menu[]
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->addLien($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removeLien($this);
        }

        return $this;
    }
}
