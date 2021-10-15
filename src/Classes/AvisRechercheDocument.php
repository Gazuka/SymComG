<?php

namespace App\Classes;

use App\Classes\Chemin;
use App\Entity\Classeur\Classeur;

class AvisRechercheDocument
{
    private $nom;
    private $parent;
    private $classeur;
    private $label;
    private $chemin;
    private $formatsAutorises = array();

    public function __construct(string $nom, object $parent, Classeur $classeur, string $label)
    {
        $this->nom = $nom;
        $this->parent = $parent;
        $this->classeur = $classeur;
        $this->label = $label;
    }

    public function setChemin(Chemin $chemin)
    {
        $this->chemin = $chemin;
    }

    public function getClasseur()
    {
        return $this->classeur;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getChemin()
    {
        return $this->chemin;
    }

    public function addFormatAutorise($format)
    {
        array_push($this->formatsAutorises, $format);
    }

    public function getFormatsAutorises()
    {
        return $this->formatsAutorises;
    }

    public function getParent()
    {
        return $this->parent;
    }
}
