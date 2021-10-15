<?php

namespace App\Entity\CarteVisite;

use App\Entity\Lieu;
use App\Entity\Profil\Profil;
use App\Entity\Poste\Poste;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Organisme\Organisme;
use App\Entity\CarteVisite\Contact\Mail;
use App\Repository\CarteVisiteRepository;
use App\Entity\CarteVisite\Contact\Adresse;
use Doctrine\Common\Collections\Collection;
use App\Entity\CarteVisite\Contact\Telephone;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CarteVisiteRepository::class)
 * @ORM\Table(name="carte_visite__carte_visite")
 */
class CarteVisite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Organisme::class, inversedBy="carteVisite", cascade={"persist"})
     */
    private $organisme;

    /**
     * @ORM\OneToMany(targetEntity=Telephone::class, mappedBy="carteVisite", orphanRemoval=true)
     */
    private $telephones;

    /**
     * @ORM\OneToMany(targetEntity=Mail::class, mappedBy="carteVisite", orphanRemoval=true)
     */
    private $mails;

    /**
     * @ORM\OneToMany(targetEntity=Adresse::class, mappedBy="carteVisite", orphanRemoval=true)
     */
    private $adresses;    

    /**
     * @ORM\OneToOne(targetEntity=Profil::class, mappedBy="carteVisite", cascade={"persist", "remove"})
     */
    private $profil;

    /**
     * @ORM\OneToOne(targetEntity=Poste::class, mappedBy="carteVisite", cascade={"persist", "remove"})
     */
    private $poste;

    /**
     * @ORM\OneToOne(targetEntity=Lieu::class, mappedBy="carteVisite", cascade={"persist", "remove"})
     */
    private $lieu;

    public function __construct()
    {
        $this->telephones = new ArrayCollection();
        $this->mails = new ArrayCollection();
        $this->adresses = new ArrayCollection();
        $this->postes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrganisme(): ?Organisme
    {
        return $this->organisme;
    }

    public function setOrganisme(?Organisme $organisme): self
    {
        $this->organisme = $organisme;

        return $this;
    }

    /**
     * @return Collection|Telephone[]
     */
    public function getTelephones(): Collection
    {
        return $this->telephones;
    }

    public function addTelephone(Telephone $telephone): self
    {
        if (!$this->telephones->contains($telephone)) {
            $this->telephones[] = $telephone;
            $telephone->setCarteVisite($this);
        }

        return $this;
    }

    public function removeTelephone(Telephone $telephone): self
    {
        if ($this->telephones->removeElement($telephone)) {
            // set the owning side to null (unless already changed)
            if ($telephone->getCarteVisite() === $this) {
                $telephone->setCarteVisite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mail[]
     */
    public function getMails(): Collection
    {
        return $this->mails;
    }

    public function addMail(Mail $mail): self
    {
        if (!$this->mails->contains($mail)) {
            $this->mails[] = $mail;
            $mail->setCarteVisite($this);
        }

        return $this;
    }

    public function removeMail(Mail $mail): self
    {
        if ($this->mails->removeElement($mail)) {
            // set the owning side to null (unless already changed)
            if ($mail->getCarteVisite() === $this) {
                $mail->setCarteVisite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setCarteVisite($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getCarteVisite() === $this) {
                $adress->setCarteVisite(null);
            }
        }

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        // unset the owning side of the relation if necessary
        if ($profil === null && $this->profil !== null) {
            $this->profil->setCarteVisite(null);
        }

        // set the owning side of the relation if necessary
        if ($profil !== null && $profil->getCarteVisite() !== $this) {
            $profil->setCarteVisite($this);
        }

        $this->profil = $profil;

        return $this;
    }

    public function getParent()
    {
        $parent = array();                
        if($this->profil != null)
        {
            $parent['nom'] = 'profil';
            $parent['objet'] = $this->profil;
        }
        if($this->organisme != null)
        {
            $parent['nom'] = 'organisme';
            $parent['objet'] = $this->organisme;
        }
        if($this->poste != null)
        {
            $parent['nom'] = 'poste';
            $parent['objet'] = $this->poste;
        }
        return $parent;
    }

    public function getPoste(): ?Poste
    {
        return $this->poste;
    }

    public function setPoste(?Poste $poste): self
    {
        // unset the owning side of the relation if necessary
        if ($poste === null && $this->poste !== null) {
            $this->poste->setCarteVisite(null);
        }

        // set the owning side of the relation if necessary
        if ($poste !== null && $poste->getCarteVisite() !== $this) {
            $poste->setCarteVisite($this);
        }

        $this->poste = $poste;

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
            $this->lieu->setCarteVisite(null);
        }

        // set the owning side of the relation if necessary
        if ($lieu !== null && $lieu->getCarteVisite() !== $this) {
            $lieu->setCarteVisite($this);
        }

        $this->lieu = $lieu;

        return $this;
    }
}
