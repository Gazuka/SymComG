<?php

namespace App\Classes;

class Question
{
    private $id;
    private $titre;
    private $ssTitre;
    private $correction = null; //Retourne true (bonne réponse) / false (mauvaise réponse) / null (pas de réponse)
    private $reponse = null;
    private $solution;

    public function __construct()
    {        
    }  
    
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitre(string $titre)
    {
        $this->titre = $titre;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setSolution(string $solution)
    {
        $this->solution = $solution;
    }

    public function getSolution()
    {
        return $this->solution;
    }

    public function setSsTitre(string $ssTitre)
    {
        $this->ssTitre = $ssTitre;
    }

    public function getSsTitre()
    {
        return $this->ssTitre;
    }

    public function getCorrection()
    {
        $this->corriger();
        return $this->correction;
    }

    public function setReponse(string $reponse)
    {
        $this->reponse = $reponse;
    }

    public function getReponse()
    {
        return $this->reponse;
    }

    private function corriger()
    {
        switch($this->reponse)
        {
            case $this->solution:
                $this->correction = true;
            break;
            case '':
                $this->correction = null;
            break;
            default:
                $this->correction = false;                
            break;
        }        
    }
}