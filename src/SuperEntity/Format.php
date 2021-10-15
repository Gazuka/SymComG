<?php

namespace App\SuperEntity;

use App\SuperEntity\Support;

abstract class Format
{
    private $id;

    //Force à créer des fonctions spécifiques
    abstract public function setSupport(Support $support): self;
}