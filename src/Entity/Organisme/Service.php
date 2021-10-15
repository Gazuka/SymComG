<?php

namespace App\Entity\Organisme;

use App\Entity\Organisme\Organisme;
use App\SuperEntity\Structure;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\PrePersist;
use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 * @ORM\Table(name="organisme__service")
 * @ORM\HasLifecycleCallbacks()
 */
class Service extends Structure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Organisme::class, inversedBy="service", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisme;

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
}
