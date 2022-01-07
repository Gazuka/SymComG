<?php

namespace App\Entity\Stats;

use App\Repository\Stats\StatsRouteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatsRouteRepository::class)
 */
class StatsRoute
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
     * @ORM\OneToMany(targetEntity=StatsLog::class, mappedBy="route")
     */
    private $statsLogs;

    public function __construct()
    {
        $this->statsLogs = new ArrayCollection();
    }

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

    /**
     * @return Collection|StatsLog[]
     */
    public function getStatsLogs(): Collection
    {
        return $this->statsLogs;
    }

    public function addStatsLog(StatsLog $statsLog): self
    {
        if (!$this->statsLogs->contains($statsLog)) {
            $this->statsLogs[] = $statsLog;
            $statsLog->setRoute($this);
        }

        return $this;
    }

    public function removeStatsLog(StatsLog $statsLog): self
    {
        if ($this->statsLogs->removeElement($statsLog)) {
            // set the owning side to null (unless already changed)
            if ($statsLog->getRoute() === $this) {
                $statsLog->setRoute(null);
            }
        }

        return $this;
    }
}
