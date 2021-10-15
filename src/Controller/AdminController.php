<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends SymComGController
{
    /**
     * Page d'accueil de l'espace d'administration
     * 
     * @Route("/admin", name="admin_accueil")
     */
    public function index(): Response
    {
        $this->setTitre('admin.accueil.titre');
        $this->setTwig('pages/admin/page____admin____accueil.html.twig');        
        return $this->afficher();
    }
    
    /**
     * PUBLIC : CHOISIR - Permet de choisir parmis une liste et retourner la réponse a la page demandeuse
     * Appelé uniquement via une redirection
     * 
     * @Route("/admin/choisir/{demandeur}", name="admin_choisir")
     * @param string $demandeur //Nom d'une des routes (qui souhaite proposer un choix)
     * @param string $titre //Titre de la page demandeuse en format trad.
     * @return Response
     */
    public function choisir($demandeur)
    {
        //Variables de session requises : choixpossibles, actionDemandeurRoute, actionDemandeurParams, nomDuChoix
        $this->setTwig('pages/admin/page____admin____choisir.html.twig');
        $this->addParamTwig('choixPossibles', $this->sessionService->lireVariable('choixPossibles'));
        $this->addParamTwig('demandeurChemin', $this->sessionService->recupChemin($demandeur));        
        $this->addParamTwig('nomDuChoix', $this->sessionService->lireVariable('nomDuChoix'));
        return $this->afficher($this->sessionService->lireVariable('titre'));
    }

    protected function preparerChoix($constante)
    {
        $choixPossibles = array();
        foreach($constante as $choix => $choixTexte)
        {
            $choixPossibles[$choix] = $this->codeTrad($choixTexte);
        }
        return $choixPossibles;
    }
    










    // === A SUPPRIMER APRES VERIFICATION DU BON FONCTIONNEMENT === DEBUG ===========
    /**
     * ALIAS - Permet de définir rapidement une page racine pour un retour rapide
     */
    protected function old_definirRacine() //DEBUG : a remplacer par enregistrerCheminActuel($nom) dans SymComGController
    {
        $this->sessionService->enregistrerVariable('actionRacineRoute', $this->requestStack->getCurrentRequest()->attributes->get('_route'));
        $this->sessionService->enregistrerVariable('actionRacineParams', $this->requestStack->getCurrentRequest()->attributes->get('_route_params'));
    }

    /**
     * ALIAS - Permet un retour rapide à la page racine
     */
    protected function old_redirectRacine() //DEBUG : a remplacer par redirectViaSession($nom) dans SymComGController
    {
        $racineRoute = $this->sessionService->lireVariable('actionRacineRoute');
        $racineParams = $this->sessionService->lireVariable('actionRacineParams');
        $this->setRedirect($racineRoute);
        foreach($racineParams as $key => $valeur)
        {
            $this->addParamRedirect($key, $valeur);
        }        
    }

    

    
}
