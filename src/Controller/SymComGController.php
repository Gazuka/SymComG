<?php

namespace App\Controller;

use DateTime;
use App\Classes\Chemin;
use App\Entity\Stats\Log;
use App\Service\FormService;
use App\Service\RepoService;
use App\Service\EntityService;
use App\Service\SessionService;
use App\Service\ClasseurService;
use App\Service\AffichageService;
use App\Service\ControllerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Security\Core\User\UserInterface;
//use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SymComGController extends AbstractController
{
    protected $affichageService;
    protected $formService;
    protected $manager;
    protected $controllerService;
    // protected $traducteur;
    protected $requestStack;
    protected $session;
    protected $sessionService;
    protected $traducteur;
    protected $entityService;
        
    //public function __construct(EntityManagerInterface $manager, AffichageService $affichageService, RepoService $repoService, FormService $formService, ControllerService $controllerService, RequestStack $requestStack, SessionInterface $session, TranslatorInterface $translator, SessionService $sessionService, ClasseurService $classeurService, EntityService $entityService)
    public function __construct(EntityManagerInterface $manager, AffichageService $affichageService, RepoService $repoService, FormService $formService, ControllerService $controllerService, RequestStack $requestStack, TranslatorInterface $translator, SessionService $sessionService, ClasseurService $classeurService, EntityService $entityService)
    {
        //Gestion de la page en cours et précédante
        $this->requestStack = $requestStack;
        //$this->session = $session;
        $this->session = $requestStack->getSession();
        $this->sessionService = $sessionService;
        $this->sessionService->setSession($this->session);
        $this->sessionService->setRequestStack($this->requestStack);
    
        // //Service traducteur
        $this->traducteur = $translator;

        //Service d'affichage
        $this->affichageService = $affichageService;

        //Service de gestion des entités
        $this->repoService = $repoService;
        $this->repoService->setManager($manager);
        $this->manager = $manager;

        //Service formulaire
        $this->formService = $formService;
        $this->formService->setRequest($requestStack);

        //Service Entity
        $this->entityService = $entityService;
        $this->entityService->setRepoService($this->repoService);

        //On appel notre ControllerService
        $this->controllerService = $controllerService;
        $this->controllerService->setAffichageService($affichageService);
        $this->controllerService->setManager($manager);

        //Classeur Service
        $this->classeurService = $classeurService;
        $classeurService->setRepoService($this->repoService);
        $classeurService->setSessionService($this->sessionService);

        //Permet d'enregistrer la page précédante et l'actuelle
        $this->sessionService->gererHistorique();
        $this->saveStats();
    }
    
    protected function saveStats()
    {
        $cheminActuel = $this->sessionService->recupChemin('cheminActuel');
        $logStats = new Log();
        $logStats->setChemin($cheminActuel);
        $logStats->setDateTime(new DateTime());
        // dump($this->session);
        $this->manager->persist($logStats);
        $this->manager->flush();
    }

    /**
     * Affiche la page requise grace au ControllerService
     */
    protected function afficher($titre = null)
    {
        //Permet de donner un titre à la page qui sera affiché
        if($titre != null)
        {
            $this->setTitre($titre);
        }
        //Affichage de la page ou de la redirection
        $returnAffichage = $this->controllerService->afficher();
        switch($returnAffichage[0])
        {
            case 'render':
                return $this->render($returnAffichage[1], $returnAffichage[2]);
            break;
            case 'redirectToRoute':
                return $this->redirectToRoute($returnAffichage[1], $returnAffichage[2]);
            break;            
            default :
                dd('DEBUG - Le controller service ne retourne pas un élément correct...');//???????????????????????????????????
            break;
        }        
    }

    /**
     * ALIAS
     * Permet l'appel de fonctions complexes plus simplement dans le code
     */
    // protected function trad($texte)
    // {
    //     return $this->traducteur->trans($texte, [], 'messages');
    // }
    protected function codeTrad(string $code, $options=[]): TranslatableMessage
    {
        return new TranslatableMessage($code, $options, 'messages+intl-icu');
    }
    protected function directTrad(string $code, $options=[]):string
    {
        $codeTrad = $this->codeTrad($code, $options);
        return $codeTrad->trans($this->traducteur);
    }

    protected function setTitre(string $code)
    {
        $codeTrad = $this->codeTrad($code);
        $this->affichageService->addParamTwig('nav_titre', $codeTrad);        
    }
    protected function setTwig($fichierTwig)
    {
        $this->affichageService->setTwig($fichierTwig);
    }
    protected function addParamTwig($cle, $valeur)
    {
        $this->affichageService->addParamTwig($cle, $valeur);
    }
    protected function setRedirect($fichierRedirect)
    {
        $this->affichageService->setRedirect($fichierRedirect);
    }
    protected function addParamRedirect($cle, $valeur)
    {
        $this->affichageService->addParamRedirect($cle, $valeur);
    }
    protected function formIsValid($form)
    {
        return $this->formService->formIsValid($form);
    }    
    protected function findAll($class)
    {
        return $this->repoService->findAll($class);
    }
    protected function findById($class, $id)
    {
        return $this->repoService->findById($class, $id);
    }
    protected function findBySlug($class, $slug)
    {
        return $this->repoService->findBySlug($class, $slug);
    }
    protected function supprimer($class, $id)
    {
        $this->repoService->deleteById($class, $id);
    }
    protected function addFlash(string $type, $message, $options=[]):void
    {
        $trad = $this->codeTrad($message, $options);
        parent::addFlash($type, $trad);
    }

    //Récupére le nom d'une classe sans le namespace
    protected function get_class_name($classname)
    {
        if ($pos = strrpos($classname, '\\')) return strtolower(substr($classname, $pos + 1));
        return strtolower($pos);
    }

    // ========================================================
    // === GESTION DES REDIRECTIONS ET SAUVEGARDE DE CHEMIN ===
    // ========================================================

    // Permet la redirection via un chemin enregistré dans la session
    protected function redirectViaSession($nom)
    {
        $chemin = $this->sessionService->lireVariable($nom);        

        $this->setRedirect($chemin->getRoute());
        foreach($chemin->getParams() as $key => $value)
        {
            $this->addParamRedirect($key, $value);
        }    
        // La redirection est effective, on peut supprimer le chemin de la session
        $this->sessionService->supprimerVariable($nom);    
    }

    /**
     * Redirige à partir d'un objet Chemin
     */
    protected function redirectViaChemin(Chemin $chemin)
    {
        $this->setRedirect($chemin->getRoute());
        foreach($chemin->getParams() as $key => $value)
        {
            $this->addParamRedirect($key, $value);
        }
    }
}