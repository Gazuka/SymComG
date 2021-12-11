<?php

namespace App\SuperEntity;

abstract class Support
{
    private $id;

    private $formatName;
    private $format;

    //Force à créer des fonctions spécifiques
    abstract public function getFormatName(): string;
    
    abstract public function getFormat();
}