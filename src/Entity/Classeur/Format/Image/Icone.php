<?php

namespace App\Entity\Classeur\Format\Image;

use App\Entity\Classeur\Support\Image;
use App\SuperEntity\Format;
use App\SuperEntity\Support;
use App\Repository\Classeur\Format\Image\IconeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IconeRepository::class)
 */
class Icone extends Format
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, inversedBy="icone", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $support;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupport(): ?Image
    {
        return $this->support;
    }

    public function setSupport(Support $support): Format
    {
        $this->support = $support;

        return $this;
    }
}
