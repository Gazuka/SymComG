<?php

namespace App\Classes;

class Question
{
    private $id;
    private $ssTitre;

    public function __construct()
    {        
    }  
    
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setSsTitre(string $ssTitre)
    {
        $this->id = $ssTitre;
    }
}
