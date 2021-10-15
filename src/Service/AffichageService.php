<?php

namespace App\Service;

class AffichageService {

    private $twig;
    private $paramsTwig = array();
    private $redirect;
    private $paramsRedirect = array();

    //GETTERS
    public function getTwig()
    {
        return $this->twig;
    }
    public function getParamsTwig()
    {
        return $this->paramsTwig;
    }
    public function getRedirect()
    {
        return $this->redirect;
    }
    public function getParamsRedirect()
    {
        return $this->paramsRedirect;
    }
    //SETTERS
    public function setTwig($twig)
    {
        $this->twig = $twig;
    }
    public function addParamTwig($cle, $valeur)
    {
        $this->paramsTwig[$cle] = $valeur;
    }
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }
    public function addParamRedirect($cle, $valeur)
    {
        $this->paramsRedirect[$cle] = $valeur;
    }
}