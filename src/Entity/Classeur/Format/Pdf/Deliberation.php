<?php

namespace App\Entity\Classeur\Format\Pdf;

use App\SuperEntity\Format;
use App\SuperEntity\Support;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Classeur\Support\Pdf;
use App\Repository\Classeur\Format\Pdf\DeliberationRepository;

/**
 * @ORM\Entity(repositoryClass=DeliberationRepository::class)
 */
class Deliberation extends Format
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity=Pdf::class, inversedBy="deliberation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $support;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSupport(): ?Pdf
    {
        return $this->support;
    }

    public function setSupport(Support $support): Format
    {
        $this->support = $support;

        return $this;
    }
}
