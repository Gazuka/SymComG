<?php

namespace App\Service;

use App\Classes\Chemin;
use App\Service\RepoService;
use App\Service\SessionService;
use App\Entity\Classeur\Classeur;
use App\Classes\AvisRechercheDocument;
use App\Entity\Classeur\EnumClasseurType;

class ClasseurService {

    const AJOUT_MEDIA = [
        'association' =>    [
                                'types' =>  [
                                                'nom' => '#profil',
                                                'descriptif' => 'admin.organisme.ajout.media.association_profil',
                                                'mediasAutorises' => [
                                                                'formats' => ['photo']
                                                            ]
                                            ],
                                            [
                                                'nom' => '#plaquette',
                                                'descriptif' => 'admin.organisme.ajout.media.association_plaquette',
                                                'mediasAutorises' => [
                                                                'formats' => ['plaquette']
                                                            ]
                                            ]
                            ],
        'entreprise' =>    [
                                'types' =>  [
                                                'nom' => '#profil',
                                                'descriptif' => 'admin.organisme.ajout.media.association_profil',
                                                'mediasAutorises' => [
                                                                'formats' => ['photo']
                                                            ]
                                            ],
                                            [
                                                'nom' => '#plaquette',
                                                'descriptif' => 'admin.organisme.ajout.media.association_plaquette',
                                                'mediasAutorises' => [
                                                                'formats' => ['plaquette']
                                                            ]
                                            ]
                            ],
        
        'profil' =>    [
                                'types' =>  [
                                                'nom' => '#portrait',
                                                'descriptif' => 'admin.profil.ajout.media.portrait',
                                                'mediasAutorises' => [
                                                                'formats' => ['photo']
                                                            ]
                                            ]
                            ],
        
        'article' =>    [
                                'types' =>  [
                                                'nom' => '#icone',
                                                'descriptif' => 'admin.article.ajout.media.icone',
                                                'mediasAutorises' => [
                                                                'formats' => ['icone']
                                                            ]
                                            ]
                            ],
        
        'service' =>        [
                                'types' =>  [
                                                'nom' => '#profil',
                                                'descriptif' => 'admin.organisme.ajout.media.service_profil',
                                                'mediasAutorises' => [
                                                                'formats' => ['photo']
                                                            ]
                                            ],
                                            [
                                                'nom' => '#plaquette',
                                                'descriptif' => 'admin.organisme.ajout.media.service_plaquette',
                                                'mediasAutorises' => [
                                                                'formats' => ['plaquette']
                                                            ]
                                            ],
                                            [
                                                'nom' => '#programme',
                                                'descriptif' => 'admin.organisme.ajout.media.service_programme',
                                                'mediasAutorises' => [
                                                                'formats' => ['programme']
                                                            ]
                                            ]
                            ],
        'elemDiapo' =>      [
                                'types' =>  [
                                                'nom' => '#images',
                                                'descriptif' => 'admin.diapo.ajout.media.image',
                                                'mediasAutorises' => [
                                                                'formats' => ['photo']
                                                            ]
                                            ]
                            ]  

    ];

    private $repoService;
    private $sessionService;
    private $avis;

    public function __construct()
    {
    }

    private function recupererAvis()
    {
        //On récupère la variable de configuration dans la session
        $this->avis = $this->sessionService->lireVariable('avisRechercheDocuments');
        if($this->avis == null)
        {
            $this->avis = array();
        }
    }

    public function setRepoService(RepoService $repoService)
    {
        $this->repoService = $repoService;
    }

    public function setSessionService(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    private function addAvis($nom, $avis)
    {
        if($this->avis == null)
        {
            $this->recupererAvis();
        }
        $this->avis[$nom] = $avis;
    }

    public function creerAvisRechercheDocument($nom, $parent, $classeur, $label, $chemin)
    {
        $avis = new AvisRechercheDocument($nom, $parent, $classeur, $label);
        $avis->setChemin($chemin);
        $this->addAvis($nom, $avis);                
        return $this;
    }

    // public function definirChemin($nomAvis, $cheminRoute, $cheminParams)
    // {
    //     $chemin = new Chemin();
    //     $chemin->setRoute($cheminRoute);
    //     $chemin->setParams($cheminParams);
    //     $this->avis[$nomAvis]->setChemin($chemin);
    // }

    public function ajouterFormatAutorise($nomAvis, $nomFormat)
    {
        $this->avis[$nomAvis]->addFormatAutorise($nomFormat);
    }

    public function enregistrerAvis()
    {
        //On enregistre la variable de configuration dans la session
        $this->sessionService->enregistrerVariable('avisRechercheDocuments', $this->avis);
    }

    /**
     * formatName est le format à comparer pour savoir si on doit afficher un bouton d'ajout
     */
    public function afficherAvis($formatName = null): Array
    {
        //On récupère les avisRechercheDocuments dans la session
        $this->recupererAvis();
        
        //On récupère uniquement les avis qui correspondent avec le formatName
        $avisEnCours = array();
        foreach($this->avis as $avis)
        {
            if($formatName != null)
            {
                if(in_array($formatName, $avis->getFormatsAutorises()))
                {
                    array_push($avisEnCours, $avis);
                }   
            }
            else
            {
                //On affiche tous les avis
                array_push($avisEnCours, $avis);
            }
        }
        return $avisEnCours;
    }

    /**
     * formatName est le format à comparer pour savoir si on doit afficher un bouton d'ajout
     */
    public function recupChemin($nomAvis): Chemin
    {
        //On récupère les avisRechercheDocuments dans la session
        $this->recupererAvis();
        return $this->avis[$nomAvis]->getChemin();
        
    }

    public function supprimerAvisRechercheDocument($nomAvis)
    {
        //On récupère les avisRechercheDocuments dans la session
        $this->recupererAvis();
        unset($this->avis[$nomAvis]);
        //On enregistre
        $this->enregistrerAvis();
    }

    public function recupAjoutMedia($nom): Array
    {
        return self::AJOUT_MEDIA[$nom];
    }

    

 
    





    public function recupererLeBonClasseur(object $parent, string $typeName): Classeur
    {
        $classeur = null;
        //On récupère le type de classeur
        $type = $this->recupererType($typeName);
        //On récupère le classeur chez le parent ou on le crée
        $classeur = $this->recupererClasseur($parent, $type);
        return $classeur;
    }

    private function recupererClasseur($parent, $type)
    {
        $classeur = null;

        if(method_exists($parent, 'getClasseurs') == true)
        {
            $classeurs = $parent->getClasseurs();
            foreach($classeurs as $classeurBoucle)
            {
                if($classeurBoucle->getType() != null)
                {
                    if($classeurBoucle->getType() == $type)
                    {
                        $classeur = $classeurBoucle;
                    }
                }
            }
        }
        else
        {
            $classeur = $parent->getClasseur();
        }

        if($classeur == null)
        {
            //Si il n'existe pas on le crée
            $classeur = new Classeur();
            $classeur->setType($type);
            $classeur->setTitre($type->getNom());
            $parent->addClasseur($classeur);
        }
        return $classeur;
    }

    private function recupererType(string $typeName)
    {
        $type = $this->repoService->findOneBy(EnumClasseurType::class, ['nom' => $typeName]);
        if($type == null)
        {
            //Si il n'existe pas on le crée
            $type = new EnumClasseurType();
            $type->setNom($typeName);
        }
        return $type;
    }

    public function recupMediasAutorises($nomAvis, $nameEntity, $typeName)
    {
        foreach(self::AJOUT_MEDIA[$nameEntity] as $type)
        {
            if($type['nom'] == $typeName)
            {
                foreach($type['mediasAutorises']['formats'] as $format)
                {
                    $this->ajouterFormatAutorise($nomAvis, $format);                
                }
            }
        }
    }

    


    
}