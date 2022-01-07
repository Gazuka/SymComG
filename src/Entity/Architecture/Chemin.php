<?php

namespace App\Entity\Architecture;

use App\Entity\Stats\StatsLog;
use App\Repository\Architecture\CheminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CheminRepository::class)
 * @ORM\Table(name="chemin2")
 */
class Chemin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=StatsLog::class, mappedBy="chemin")
     */
    private $statsLogs;

    /**
     * @ORM\ManyToOne(targetEntity=Route::class, inversedBy="chemins", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $route;

    /**
     * @ORM\ManyToMany(targetEntity=RouteParam::class, inversedBy="chemins", cascade={"persist", "remove"})
     */
    private $routeparams;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    public function recupParam($paramName)
    {
        $value = null;
        foreach($this->routeparams as $routeparam)
        {
            if($routeparam->getParam() == $paramName)
            {
                $value = $routeparam->getValeur();
                break;
            }
        }
        return $value;
    }

    public function returnIdParams()
    {
        $ids = [];
        foreach($this->routeparams as $routeparam)
        {
            array_push($ids, $routeparam->getId());
        }
        return $ids;
    }

    public function __construct()
    {
        $this->statsLogs = new ArrayCollection();
        $this->routeparams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $statsLog->setChemin($this);
        }

        return $this;
    }

    public function removeStatsLog(StatsLog $statsLog): self
    {
        if ($this->statsLogs->removeElement($statsLog)) {
            // set the owning side to null (unless already changed)
            if ($statsLog->getChemin() === $this) {
                $statsLog->setChemin(null);
            }
        }

        return $this;
    }

    public function getRoute(): ?Route
    {
        return $this->route;
    }

    public function setRoute(?Route $route): self
    {
        $this->route = $route;

        return $this;
    }

    /**
     * @return Collection|RouteParam[]
     */
    public function getRouteparams(): Collection
    {
        return $this->routeparams;
    }

    public function addRouteparam(RouteParam $routeparam): self
    {
        if (!$this->routeparams->contains($routeparam)) {
            $this->routeparams[] = $routeparam;
        }

        return $this;
    }

    public function removeRouteparam(RouteParam $routeparam): self
    {
        $this->routeparams->removeElement($routeparam);

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
