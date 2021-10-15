<?php

namespace App\Entity\CarteVisite\Contact;

use App\SuperEntity\Contact;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\CarteVisite\CarteVisite;
use App\Repository\TelephoneRepository;

/**
 * @ORM\Entity(repositoryClass=TelephoneRepository::class)
 * @ORM\Table(name="carte_visite_contact__telephone")
 */
class Telephone extends Contact
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
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity=CarteVisite::class, inversedBy="telephones", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $carteVisite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        $num = $this->numero;
        $num = str_replace(' ', '', $num);
        $num = str_replace('.', '', $num);
        $num = implode(' ', str_split($num, 2));
        return $num;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
}