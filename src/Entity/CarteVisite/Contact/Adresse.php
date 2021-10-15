<?php

namespace App\Entity\CarteVisite\Contact;

use App\SuperEntity\Contact;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AdresseRepository;
use App\Entity\CarteVisite\CarteVisite;

/**
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 * @ORM\Table(name="carte_visite_contact__adresse")
 */
class Adresse extends Contact
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
    private $numero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rue1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rue2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity=CarteVisite::class, inversedBy="adresses", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $carteVisite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getRue1(): ?string
    {
        return $this->rue1;
    }

    public function setRue1(?string $rue1): self
    {
        $this->rue1 = $rue1;

        return $this;
    }

    public function getRue2(): ?string
    {
        return $this->rue2;
    }

    public function setRue2(?string $rue2): self
    {
        $this->rue2 = $rue2;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(?int $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCarteVisite(): ?CarteVisite
    {
        return $this->carteVisite;
    }

    public function setCarteVisite(?CarteVisite $carteVisite): Contact
    {
        $this->carteVisite = $carteVisite;

        return $this;
    }
}
