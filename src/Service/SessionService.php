<?php

namespace App\Service;

use App\Classes\Chemin;
use Symfony\Component\HttpFoundation\RequestStack;
//use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionService {

    private $session;
    private $requestStack;
    
    //Enregistres une variable dans la session
    public function enregistrerVariable($nom, $valeur)
    {
        $this->session->set($nom, $valeur);
    }
    
    //Retourne la valeur d'une variable dans la session
    public function lireVariable($nom)
    {
        return $this->session->get($nom);
    }
    
    //Supprime une variable de la session
    public function supprimerVariable($nom)
    {
        $this->session->remove($nom);
    }

    // Enregistre la page actuelle et la page précédante
    public function gererHistorique()
    {
        //Le chemin enregistré en tant qu'actuel devient le precedant
        $this->enregistrerVariable('cheminPrecedant', $this->lireVariable('cheminActuel'));
        //On enregistre le chemin Actuel
        $this->enregistrerCheminActuel('cheminActuel');
    }

    // Permet la mise en forme d'un chemin pour une redirection
    public function creerChemin($nom, $route, $params)
    {
        $chemin = new Chemin();
        $chemin->setRoute($route);
        $chemin->setParams($params);
        $this->enregistrerVariable($nom, $chemin);
        return $chemin;
    }

    public function recupChemin($nom): Chemin
    {
        $chemin = $this->lireVariable($nom); 
        return $chemin;
    }

    // Enregistre le chemin Actuel avec le nom souhaité
    public function enregistrerCheminActuel($nom)
    {
        $route = $this->requestStack->getCurrentRequest()->attributes->get('_route');
        $params = $this->requestStack->getCurrentRequest()->attributes->get('_route_params');
        $this->creerChemin($nom, $route, $params);
    }
    // Enregistre le chemin Précedant avec le nom souhaité
    public function enregistrerCheminPrecedant($nom)
    {
        $chemin = $this->recupChemin('cheminPrecedant');
        $this->enregistrerVariable($nom, $chemin);
    }

    //GET & SET
    //public function setSession(SessionInterface $session):self
    public function setSession($session):self
    {
        $this->session = $session;
        return $this;
    }
    public function setRequestStack(RequestStack $requestStack):self
    {
        $this->requestStack = $requestStack;
        return $this;
    }
}