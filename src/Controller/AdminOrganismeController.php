<?php

namespace App\Controller;

use App\Entity\Menu\Lien;
use App\Form\ServiceType;
use App\Form\EntrepriseType;
use App\Entity\Visuel\Visuel;
use App\Form\AssociationType;
use App\Entity\Agenda\Horaire;
use App\Entity\Classeur\Dossier;
use App\Entity\Classeur\Classeur;
use App\Entity\Organisme\Service;
use App\Entity\Organisme\Organisme;
use App\Form\Classeur\ClasseurType;
use App\Entity\Organisme\Entreprise;
use App\Entity\Organisme\Association;
use App\Entity\CarteVisite\CarteVisite;
use App\Entity\Classeur\EnumClasseurType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatableMessage;

class AdminOrganismeController extends AdminController
{
    
    const CHOIX_POSSIBLES = [
                                'association' =>'admin.organisme.choisir.association',
                                'service' => 'admin.organisme.choisir.service',
                                'entreprise' => 'admin.organisme.choisir.entreprise'
                            ];
    
    // const AJOUT_MEDIA = [
    //                         'association' =>    [
    //                                                 'types' =>  [
    //                                                                 'nom' => '#profil',
    //                                                                 'descriptif' => 'admin.organisme.ajout.media.association_profil',
    //                                                                 'mediasAutorises' => [
    //                                                                                 'formats' => ['photo']
    //                                                                             ]
    //                                                             ],
    //                                                             [
    //                                                                 'nom' => '#plaquette',
    //                                                                 'descriptif' => 'admin.organisme.ajout.media.association_plaquette',
    //                                                                 'mediasAutorises' => [
    //                                                                                 'formats' => ['plaquette']
    //                                                                             ]
    //                                                             ]
    //                                             ]                            
    //                     ];

    /**
     * PUBLIC : CREER - Permet de créer un nouvel organisme (entreprise, association, service...)
     * 
     * @Route("/admin/organisme/creer/{structureName?}", name="admin_organisme_creer")
     * @param string $structureName //Nom du type de structure à créer (associations, services, entreprises...)
     * @return Response
     */
    public function creerStructure($structureName): Response
    {
        $this->genererFormulaire($structureName);
        return $this->afficher('admin.organisme.creer.titre.'.$structureName);
    }  

    /**
     * PUBLIC : EDITER - Editer un organisme
     * @Route("/admin/organisme/editer/{idorganisme}", name="admin_organisme_editer", requirements={"idorganisme"="\-?[0-9]+"})
     * @param integer $idorganisme
     * @return Response
     */
    public function editerOrganisme(int $idorganisme):Response
    {
        //Récupérer l'organisme
        $organisme = $this->findById(Organisme::class, $idorganisme);
        $structureName = $organisme->getTypeStructure();
        $structure = $organisme->getStructure();
        $this->genererFormulaire($structureName, $structure);
        return $this->afficher('admin.organisme.editer.titre.'.$structureName);
    }
    
    /**
     * PUBLIC : VOIR - Afficher un Organisme
     * @Route("/admin/organisme/{idorganisme}", name="admin_organisme_gerer", requirements={"idorganisme"="\-?[0-9]+"})
     * @param integer $idorganisme
     * @return Response
     */
    public function voirOrganisme(int $idorganisme): Response
    {
        //Définir un point d'encrage ici pour un retour
        $this->sessionService->enregistrerCheminActuel('cheminOrganisme');
        //Récupérer l'organisme
        $organisme = $this->repoService->findById(Organisme::class, $idorganisme);
        $structureName = $organisme->getTypeStructure();
        //Affichage
        $this->setTwig('pages/admin_organisme/page____admin_organisme____organisme____gerer.html.twig'); 
        $this->addParamTwig('organisme', $organisme);
        $this->addParamTwig('ajout_media', $this->classeurService->recupAjoutMedia($structureName));
        return $this->afficher('admin.organisme.voir.titre.'.$structureName);
    }

    /**
     * PUBLIC : VOIR - Afficher l'ensemble des structures d'un type (association, entreprise, service...)
     * 
     * @Route("/admin/organisme/{structureName?}", name="admin_organisme_structures_voir")
     * @param string $structureName //Nom du type de structure à afficher (associations, services, entreprises...)
     * @return Response
     */
    public function voirStructures($structureName = null): Response
    {
        $parametres = $this->recupererClasseStructure($structureName);
        if($parametres != null)
        {
            //Récupérer toutes les structure du type demandé
            $structures = $this->findAll($parametres['structureClasse']);
            //Affichage            
            $this->setTwig('pages/admin_organisme/page____admin_organisme____structures____voir.html.twig');
            $this->addParamTwig('structures', $structures);
        }else{/* Si parametres est null c'est qu'une redirection est prévu dans recupererClasseStructure */}
        //Affichage        
        return $this->afficher('admin.organisme.structures.voir.titre.'.$structureName);        
    }

    /**
     * PUBLIC : SUPPRIMER - Supprimer un organisme
     * 
     * @Route("/admin/organisme/supprimer/{idorganisme}", name="admin_organisme_supprimer", requirements={"idorganisme"="\-?[0-9]+"})
     * @param integer $idorganisme
     * @return Response
     */
    public function supprimerOrganisme(int $idorganisme):Response
    {
        //Supprimer de la BDD
        $this->supprimer(Organisme::class, $idorganisme);
        //Message
        $this->addFlash('success', 'admin.organisme.supprimer.flash.success');
        //Affichage
        $this->setRedirect('admin');
        return $this->afficher();
    }

    /**
     * PUBLIC : ATTACHER CarteVisite - Créer une nouvelle carte de visite vierge
     * 
     * @Route("/admin/organisme/cartevisite/{idorganisme}", name="admin_organisme_cartevisite", requirements={"idorganisme"="\-?[0-9]+"})
     * @param integer $idorganisme
     * @return Response
     */
    public function attacherCarteVisite(int $idorganisme):Response
    {
        //Récupérer l'organisme
        $organisme = $this->findById(Organisme::class, $idorganisme);
        //Créer et attacher la carte de visite
        $carteVisite = new CarteVisite();
        $organisme->setCarteVisite($carteVisite);
        $this->manager->persist($organisme);
        $this->manager->flush();
        $this->setRedirect('admin_organisme_gerer');
        $this->addParamRedirect('idorganisme', $idorganisme);
        return $this->afficher();
    }

    /**
     * PUBLIC : ATTACHER Visuel - Créer un nouveau visuel vierge
     * 
     * @Route("/admin/organisme/visuel/{idorganisme}", name="admin_organisme_visuel", requirements={"idorganisme"="\-?[0-9]+"})
     * @param integer $idorganisme
     * @return Response
     */
    public function attacherVisuel(int $idorganisme):Response
    {
        //Récupérer l'organisme
        $organisme = $this->findById(Organisme::class, $idorganisme);
        //Créer et attacher le visuel
        $visuel = new Visuel();
        $organisme->setVisuel($visuel);
        $this->manager->persist($organisme);
        $this->manager->flush();
        $this->setRedirect('admin_organisme_gerer');
        $this->addParamRedirect('idorganisme', $idorganisme);
        return $this->afficher();
    }

    /**
     * PUBLIC : ATTACHER Horaire - Créer un nouveau horaire
     * 
     * @Route("/admin/organisme/horaire/{idorganisme}", name="admin_organisme_horaire", requirements={"idorganisme"="\-?[0-9]+"})
     * @param integer $idorganisme
     * @return Response
     */
    public function attacherHoraire(int $idorganisme):Response
    {
        //Récupérer l'organisme
        $organisme = $this->findById(Organisme::class, $idorganisme);
        //Créer et attacher le visuel
        $horaire = new Horaire();
        $visuel = new Visuel(); // Visuel de l'horaire (a changer par la suite DEBUG)
        $horaire->setVisuel($visuel);
        $organisme->setHoraire($horaire);
        $this->manager->persist($horaire);
        $this->manager->persist($organisme);
        $this->manager->flush();
        $this->setRedirect('admin_organisme_gerer');
        $this->addParamRedirect('idorganisme', $idorganisme);
        return $this->afficher();
    }

    /**
     * PUBLIC : ATTACHER Lien - Créer une nouveau lien
     * 
     * @Route("/admin/organisme/lien/{idorganisme}", name="admin_organisme_lien", requirements={"idorganisme"="\-?[0-9]+"})
     * @param integer $idorganisme
     * @return Response
     */
    public function attacherLien(int $idorganisme):Response
    {
        //Récupérer l'organisme
        $organisme = $this->findById(Organisme::class, $idorganisme);
        //Créer et attacher le lien
        $lien = new Lien();
        $lien->setTitre($organisme->getStructure()->getNom());
        $lien->setDescriptif("TRAD : Lien vers...");
        $organisme->addLien($lien);
        $this->manager->persist($organisme);
        $this->manager->flush();
        $this->setRedirect('admin_menu_lien_gerer');
        $this->addParamRedirect('idlien', $lien->getId());
        $this->sessionService->enregistrerCheminPrecedant('attacherLienOrganisme');        
        return $this->afficher();
    }

    /**
     * PUBLIC : Ajouter un Média
     * 
     * @Route("/admin/organisme/classeur/joindre/{idorganisme}/{typeName}", name="admin_organisme_classeur_ajouter_media", requirements={"idorganisme"="\-?[0-9]+"})
     * @param integer $idorganisme
     * @return Response
     */
    public function addMedia(int $idorganisme, string $typeName): Response
    {
        //Récupérer l'organisme
        $organisme = $this->findById(Organisme::class, $idorganisme);
        //Récupérer ou créer le classeur selon le type et l'enregistrer
        $classeur = $this->classeurService->recupererLeBonClasseur($organisme, $typeName);
        $this->manager->persist($classeur);
        $this->manager->flush();
        
        //Création d'un avisRechecheDocument
        $nomAvis = 'organisme';
        $this->classeurService->creerAvisRechercheDocument($nomAvis, $organisme, $classeur, 'admin.organisme.joindre.media.bouton.label');
        $this->classeurService->definirChemin($nomAvis, 'admin_organisme_gerer', ['idorganisme' => $idorganisme]);
        $this->recupMediasAutorises($nomAvis, $organisme->getTypeStructure(), $typeName);
        $this->classeurService->enregistrerAvis($nomAvis);
        
        //Redirection vers la gestion des médias
        $this->setRedirect('admin_medias');
        //Affichage        
        return $this->afficher();
    }

    // private function recupMediasAutorises($nomAvis, $structureName, $typeName)
    // {
    //     foreach(self::AJOUT_MEDIA[$structureName] as $type)
    //     {
    //         if($type['nom'] == $typeName)
    //         {
    //             foreach($type['mediasAutorises']['formats'] as $format)
    //             {
    //                 $this->classeurService->ajouterFormatAutorise($nomAvis, $format);                
    //             }
    //         }
    //     }
    // }

    
    /**
     * PRIVE 
     * Permet de récupérer les classes utiles en fonction du type de structure
     * @param string $structureName //Nom du type de structure à afficher (associations, services, entreprises...)
     * @param string $demandeur //Nom de la route ayant fait la demande
     * @return Array
     */
    private function recupererClasseStructure($structureName)
    {
        $resultat = null;
        switch($structureName)
        {
            case 'association':
                $resultat['structure'] = new Association();
                $resultat['structureClasse'] = Association::class;
                $resultat['structureTypeClasse'] =  AssociationType::class;
            break;
            case 'service':
                $resultat['structure'] = new Service();
                $resultat['structureClasse'] = Service::class;
                $resultat['structureTypeClasse'] =  ServiceType::class;
            break;
            case 'entreprise':
                $resultat['structure'] = new Entreprise();
                $resultat['structureClasse'] = Entreprise::class;
                $resultat['structureTypeClasse'] =  EntrepriseType::class;
            break;
            default:
                $demandeur = 'demandeurDeStructure';
                $this->setRedirect('admin_choisir');
                $this->addParamRedirect('demandeur', $demandeur);
                //Enregistrer les infos dans la session pour le retour ici après le traitement
                $this->sessionService->enregistrerVariable('choixPossibles', $this->preparerChoix(self::CHOIX_POSSIBLES));
                $this->sessionService->enregistrerVariable('nomDuChoix', 'structureName');
                $this->sessionService->enregistrerVariable('titre', $this->codeTrad('admin.organisme.structures.choisir'));
                $this->sessionService->enregistrerCheminActuel($demandeur);
            break;
        }
        return $resultat;
    }

    /**
     * PRIVE : GENERER - Génère un formulaire en fonction du type d'Organisme (Association, Entreprise, Structure...)
     * @param string $structureName //Nom du type de structure à afficher (associations, services, entreprises...)
     * @param string $demandeur //Nom de la route ayant fait la demande
     * @param object $structure //Objet qui sera édité si c'est un formulaire d'édition
     * @return void
     */
    private function genererFormulaire($structureName, $structure = null): void
    {
        $parametres = $this->recupererClasseStructure($structureName);
        if($parametres != null)
        {
            if($structure == null)
            {
                $structure = $parametres['structure'];
            }
            //Formulaire        
            $form = $this->createForm($parametres['structureTypeClasse'], $structure);
            if($this->formIsValid($form))
            {
                if($structure->getOrganisme() == null)
                {
                    $organisme = new Organisme();
                    $structure->setOrganisme($organisme);                                       
                }                                
                $this->manager->persist($structure);
                $this->manager->flush();
                $this->addFlash('success', 'admin.organisme.form.flash.success.'.$structureName);
                $this->setRedirect('admin_organisme_gerer');
                $this->addParamRedirect('idorganisme', $structure->getOrganisme()->getId());
            }
            //Affichage        
            $this->setTwig('pages/admin_organisme/page____admin_organisme____organisme____form.html.twig');
            $this->addParamTwig('typeOrganisme', $this->get_class_name(get_class($structure)));
            $this->addParamTwig('form', $form->createView());        
        }
    }      
}