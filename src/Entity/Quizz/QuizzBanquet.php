<?php

namespace App\Entity\Quizz;

use App\Repository\Quizz\QuizzBanquetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuizzBanquetRepository::class)
 */
class QuizzBanquet
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numCarteIdentite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom2;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaissance2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numCarteIdentite2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $numBus;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getNumCarteIdentite(): ?string
    {
        return $this->numCarteIdentite;
    }

    public function setNumCarteIdentite(string $numCarteIdentite): self
    {
        $this->numCarteIdentite = $numCarteIdentite;

        return $this;
    }

    public function getNom2(): ?string
    {
        return $this->nom2;
    }

    public function setNom2(?string $nom2): self
    {
        $this->nom2 = $nom2;

        return $this;
    }

    public function getPrenom2(): ?string
    {
        return $this->prenom2;
    }

    public function setPrenom2(?string $prenom2): self
    {
        $this->prenom2 = $prenom2;

        return $this;
    }

    public function getDateNaissance2(): ?\DateTimeInterface
    {
        return $this->dateNaissance2;
    }

    public function setDateNaissance2(?\DateTimeInterface $dateNaissance2): self
    {
        $this->dateNaissance2 = $dateNaissance2;

        return $this;
    }

    public function getNumCarteIdentite2(): ?string
    {
        return $this->numCarteIdentite2;
    }

    public function setNumCarteIdentite2(?string $numCarteIdentite2): self
    {
        $this->numCarteIdentite2 = $numCarteIdentite2;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNumBus(): ?int
    {
        return $this->numBus;
    }

    public function setNumBus(int $numBus): self
    {
        $this->numBus = $numBus;

        return $this;
    }
}
