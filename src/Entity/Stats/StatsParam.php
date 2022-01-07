<?php

namespace App\Entity\Stats;

use App\Repository\Stats\StatsParamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatsParamRepository::class)
 */
class StatsParam
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
    private $valeur;

    /**
     * @ORM\ManyToMany(targetEntity=StatsLog::class, mappedBy="params")
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

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(string $valeur): self
    {
        $this->valeur = $valeur;

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
            $statsLog->addParam($this);
        }

        return $this;
    }

    public function removeStatsLog(StatsLog $statsLog): self
    {
        if ($this->statsLogs->removeElement($statsLog)) {
            $statsLog->removeParam($this);
        }

        return $this;
    }
}
