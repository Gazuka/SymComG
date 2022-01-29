<?php

namespace App\Service;

use DateTime;

class DatesService {

    /*---
        Temporalité :
            Pas en ligne : _offline_
            Prêt pour le futur : _ready_
            En ligne et permanent : _permanent_
            En ligne pour une durée limitée : _online_
    ---*/

    private $now;

    private function now()
    {
        $this->now = new DateTime();
    }
    
    public function localiserCreneau($debut, $fin)
    {
        $this->now();
        if($debut != null)
        {
            // Il y a une date de début
            if($this->now < $debut)
            {
                // La date de début et dans le futur
                $temporalite = '_ready_';
            }
            else
            {
                // La date de début est déjà passée
                if($fin == null)
                {
                    // Il n'y a pas de date de fin c'est donc un permanent
                    $temporalite = '_permanent_';
                }
                else
                {
                    // Il y a une date de fin
                    if($this->now < $fin)
                    {
                        // La date de fin est dans le futur c'est donc en ligne
                        $temporalite = '_online_';
                    }
                    else
                    {
                        // La date de fin est passée, c'est donc une archive
                        $temporalite = '_archive_';
                    }
                }
            }
        }
        else
        {
            // Il n'y a pas de date de début, c'est donc un brouillon
            $temporalite = '_offline_';
        }
        return $temporalite;
    }
}