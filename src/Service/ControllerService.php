<?php

namespace App\Service;

use App\Service\ControllerService;
use Doctrine\ORM\EntityManagerInterface;

class ControllerService {
    
    private $affichageService;
    private $manager;

    public function __construct()
    {
    }

    //GETTERS
    public function getAffichageService()
    {
        return $this->affichageService;
    }
    public function getManager()
    {
        return $this->manager;
    }
    //SETTERS
    public function setAffichageService($affichageService)
    {
        $this->affichageService = $affichageService;
    }
    public function setManager($manager)
    {
        $this->manager = $manager;
    }

    /**
     * Unique fonction appelé par le Controller et qui retourne les éléments nécessaire via returnAction
     */
    public function afficher()
    {
        $this->manager->flush();
        if($this->affichageService->getRedirect() == null)
        {
            //On retourne les infos au Controller pour l'affichage réel
            return $this->returnAction('render', $this->affichageService->getTwig(), $this->affichageService->getParamsTwig());
        }
        else
        {
            //On retourne les infos au Controller pour la redirection réelle
            return $this->returnAction('redirectToRoute', $this->affichageService->getRedirect(), $this->affichageService->getParamsRedirect());
        }        
    }    

    /**
     * Retourne un tableau au controller afin qu'il lance lui même l'action demandée
     */
    private function returnAction($action, $cible, $params)
    {
        return [$action, $cible, $params];
    }
    
}