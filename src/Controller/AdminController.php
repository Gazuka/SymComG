<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends SymComGController
{
    //Constantes à définir dans les classes filles
    const CONTROLLER_NAME = 'undefined'; //nom du controller (pour twig)
    const CLASS_OBJET = 'undefined'; //classe de l'entité
    const CLASS_FORM = 'undefined'; //classe du formulaire de l'entité
    const NAMESPACE_OBJET = 'undefined'; //NameSpace de l'entité
    const OBJETS_NAME = 'undefined'; //nom de l'objet au pluriel
    const OBJET_NAME = 'undefined'; //nom de l'objet au singulier

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
    
    protected function voirTout(): Response
    {
        $c = get_called_class();
        //Récupération de tous les objets
        $objets = $this->findAll($c::CLASS_OBJET);
        //Affichage
        $this->setTwig('pages/'.$c::CONTROLLER_NAME.'/page____'.$c::CONTROLLER_NAME.'____'.$c::OBJETS_NAME.'____voir.html.twig');
        $this->addParamTwig($c::OBJETS_NAME, $objets);
        return $this->afficher('admin.'.$c::OBJETS_NAME.'.voir.titre');
    }

    /**
     * Création d'une page pour une nouvelle entité
     */
    protected function creerObjet(): Response
    {
        $c = get_called_class();
        return $this->afficher('admin.'.$c::OBJET_NAME.'.creer.titre');
    }

    /**
     * Création d'une page pour une gérer une entité
     */
    protected function gererObjet($idObjet, $page): Response
    {
        $c = get_called_class();
        $objet = $this->findById($c::CLASS_OBJET, $idObjet);
        $this->creerFormulaire($objet, $page);
        $this->setTwig('pages/'.$c::CONTROLLER_NAME.'/page____'.$c::CONTROLLER_NAME.'____'.$c::OBJET_NAME.'____gerer.html.twig');
        $this->addParamTwig($c::OBJET_NAME, $objet);
        return $this->afficher('admin.'.$c::OBJET_NAME.'.gerer.titre');    
    }

    /**
     * Création d'un formulaire pour une entité
     * @return Void
     */
    protected function creerFormulaire($objet=null, $redirect): Object
    {
        $c = get_called_class();
        if($objet == null)
        {
            $class = $c::NAMESPACE_OBJET;
            $objet = new $class;
        }
        //Formulaire        
        $form = $this->createForm($c::CLASS_FORM, $objet);
        if($this->formIsValid($form))
        {
            $this->manager->persist($objet);
            $this->manager->flush();
            $this->addFlash('success', 'admin.'.$c::OBJET_NAME.'.form.flash.success');
            $this->setRedirect($redirect);
            $this->addParamRedirect('id'.$c::OBJET_NAME, $objet->getId());
        }
        //Affichage        
        $this->setTwig('pages/'.$c::CONTROLLER_NAME.'/page____'.$c::CONTROLLER_NAME.'____'.$c::OBJET_NAME.'____form.html.twig');
        $this->addParamTwig('form', $form->createView());        
        return $objet;
    }

    protected function twigAjoutMedia($nom, $cheminActuel)
    {
        $this->addParamTwig('sessionService', $this->sessionService);
        $this->addParamTwig('ajout_media', $this->classeurService->recupAjoutMedia($nom));
        $this->sessionService->enregistrerCheminActuel($cheminActuel);
    }

    protected function ajouterMedia(int $idObjet, string $typeName)
    {
        $c = get_called_class();
        $objet = $this->findById($c::CLASS_OBJET, $idObjet);
        //Récupérer ou créer le classeur selon le type et l'enregistrer
        $classeur = $this->classeurService->recupererLeBonClasseur($objet, $typeName);
        $this->manager->persist($classeur);
        $this->manager->flush();
        //Création d'un avisRechecheDocument
        $nomAvis = $c::OBJET_NAME;
        $this->classeurService->creerAvisRechercheDocument($nomAvis, $objet, $classeur, 'admin.'.$c::OBJET_NAME.'.joindre.media.bouton.label', $this->sessionService->recupChemin('cheminPrecedant'));
        $this->classeurService->recupMediasAutorises($nomAvis, $c::OBJET_NAME, $typeName);
        $this->classeurService->enregistrerAvis($nomAvis);
        //Redirection vers la gestion des medias
        $this->setRedirect('admin_medias');
        //Affichage        
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
