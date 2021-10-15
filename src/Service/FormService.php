<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

class FormService
{
    private $request;
    
    public function setRequest(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }
    
    public function formIsValid($form):bool
    {
        $valid = false;
        if($this->request->isMethod('POST') && $form->handleRequest($this->request)->isValid())
        {
            $valid = true;
        }
        return $valid;
    }
}