<?php

namespace App\Entity\CarteVisite\Contact;

use App\SuperEntity\Contact;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MailRepository;
use App\Entity\CarteVisite\CarteVisite;

/**
 * @ORM\Entity(repositoryClass=MailRepository::class)
 * @ORM\Table(name="carte_visite_contact__mail")
 */
class Mail extends Contact
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
    private $courriel;

    /**
     * @ORM\ManyToOne(targetEntity=CarteVisite::class, inversedBy="mails", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $carteVisite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourriel(): ?string
    {
        return $this->courriel;
    }

    public function setCourriel(string $courriel): self
    {
        $this->courriel = $courriel;

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
