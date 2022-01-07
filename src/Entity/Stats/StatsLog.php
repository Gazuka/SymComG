<?php

namespace App\Entity\Stats;

use App\Entity\Architecture\Chemin;
use App\Repository\Stats\StatsLogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatsLogRepository::class)
 */
class StatsLog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateTime;

    /**
     * @ORM\ManyToOne(targetEntity=Chemin::class, inversedBy="statsLogs", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $chemin;

    public function __construct()
    {
        $this->params = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoute(): ?StatsRoute
    {
        return $this->route;
    }

    public function setRoute(?StatsRoute $route): self
    {
        $this->route = $route;

        return $this;
    }

    /**
     * @return Collection|StatsParam[]
     */
    public function getParams(): Collection
    {
        return $this->params;
    }

    public function addParam(StatsParam $param): self
    {
        if (!$this->params->contains($param)) {
            $this->params[] = $param;
        }

        return $this;
    }

    public function removeParam(StatsParam $param): self
    {
        $this->params->removeElement($param);

        return $this;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTimeInterface $dateTime): self
    {
        $this->dateTime = $dateTime;

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
}
