<?php

namespace App\Controller;

use App\Entity\Visuel\ElemX;
use App\Entity\Visuel\Visuel;
use App\Controller\AdminController;
use App\Entity\Visuel\Element\ElemZone;
use App\Entity\Visuel\Element\ElemDiapo;
use App\Entity\Visuel\Element\ElemTexte;
use App\Entity\Visuel\Element\ElemTitre;
use App\Form\Visuel\Element\ElemZoneType;
use App\Form\Visuel\Element\ElemDiapoType;
use App\Form\Visuel\Element\ElemTexteType;
use App\Form\Visuel\Element\ElemTitreType;
use App\Entity\Visuel\Element\ElemOrganisme;
use App\Form\Visuel\Element\ElemOrganismeType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminVisuelController extends AdminController
{
    const CHOIX_POSSIBLES = [
        'elemZone' =>'admin.visuel.element.choisir.zone',
        'elemTexte' =>'admin.visuel.element.choisir.texte',
        'elemDiapo' =>'admin.visuel.element.choisir.diapo',
        'elemOrganisme' =>'admin.visuel.element.choisir.organisme',
        'elemTitre' =>'admin.visuel.element.choisir.titre',
    ];

    /**
     * @Route("/admin/visuel/element/ajouter/{idvisuel}/{idelemxconteneur}/{elementName?}", name="admin_visuel_element_ajouter", requirements={"idvisuel"="\-?[0-9]+", "idelemxconteneur"="\-?[0-9]+"})
     */
    public function ajouterElement(int $idvisuel, int $idelemxconteneur, string $elementName = null): Response
    {
        $this->genererFormulaire($idvisuel, $elementName, $idelemxconteneur);
        return $this->afficher('trad: titre de la creation element');
    }

    /**
     * @Route("/admin/visuel/element/supprimer/{idelemx}", name="admin_visuel_element_supprimer", requirements={"idelemx"="\-?[0-9]+"})
     */
    public function supprimerElement(int $idelemx): Response
    {
        $elemX = $this->findById(elemX::class, $idelemx);
        dump($elemX);
        if($elemX->getParent() != null)
        {
            $elemX->getParent()->removeElement($elemX);
        }   
        // $this->manager->persist($elemX);
        // $this->manager->flush();
        $this->supprimer(elemX::class, $idelemx);
        $this->redirectViaSession('cheminPrecedant');
        return $this->afficher();
    }

    /**
     * @Route("/admin/visuel/element/modifier/{idvisuel}/{idelemx}/{elementName?}", name="admin_visuel_element_modifier", requirements={"idvisuel"="\-?[0-9]+", "idelemxconteneur"="\-?[0-9]+"})
     */
    public function modifierElement(int $idvisuel, int $idelemx, string $elementName = null): Response
    {
        $elemx = $this->findById(ElemX::class, $idelemx);
        $element = $elemx->getElement();
        $idelemxconteneur = $elemx->getParent()->getElemX()->getId();
        $elementName = $this->get_class_name(get_class($element));
        $this->genererFormulaire($idvisuel, $elementName, $idelemxconteneur, $element);
        return $this->afficher('trad: titre de la modification element');
    }

    /**
     * @Route("/admin/visuel/element/modifier/taillexl/{idzone}/{taille}", name="admin_visuel_element_modifier_zone_taille", requirements={"idzone"="\-?[0-9]+", "taille"="\-?[0-9]+"})
     */
    public function modifierElementZoneTaille(int $idzone, int $taille): Response
    {
        if($taille > 0 && $taille <= 12)
        {
            $elemZone = $this->findById(ElemZone::class, $idzone);
            $elemZone->setTailleXl($taille);
            $this->manager->persist($elemZone);
            $this->manager->flush();            
        }
        $this->redirectViaSession('cheminPrecedant');
        return $this->afficher();
    }

    /**
     * @Route("/admin/visuel/element/modifier/position/{idelemx}/{signe}", name="admin_visuel_element_modifier_position", requirements={"idelemx"="\-?[0-9]+", "taille"="\-?[0-9]+"})
     */
    public function modifierElementPosition(int $idelemx, string $signe): Response
    {
        $elemx = $this->findById(ElemX::class, $idelemx);
        if($signe == 'moins')
        {
            $elemx->getParent()->baissePosition($elemx);            
        }
        else
        {
            $elemx->getParent()->montePosition($elemx);
        }
        $this->manager->persist($elemx);
        $this->manager->flush();           
        
        $this->redirectViaSession('cheminPrecedant');
        return $this->afficher();
    }

    private function recupererClasseElement($elementName)
    {
        $resultat = null;
        switch(strtolower($elementName))
        {
            case 'elemzone':
                $resultat['element'] = new ElemZone();
                $resultat['elementClasse'] = ElemZone::class;
                $resultat['elementTypeClasse'] =  ElemZoneType::class;
            break;
            case 'elemtexte':
                $resultat['element'] = new ElemTexte();
                $resultat['elementClasse'] = ElemTexte::class;
                $resultat['elementTypeClasse'] =  ElemTexteType::class;
            break;
            case 'elemdiapo':
                $resultat['element'] = new ElemDiapo();
                $resultat['elementClasse'] = ElemDiapo::class;
                $resultat['elementTypeClasse'] =  ElemDiapoType::class;
            break;
            case 'elemorganisme':
                $resultat['element'] = new ElemOrganisme();
                $resultat['elementClasse'] = ElemOrganisme::class;
                $resultat['elementTypeClasse'] =  ElemOrganismeType::class;
            break;
            case 'elemtitre':
                $resultat['element'] = new ElemTitre();
                $resultat['elementClasse'] = ElemTitre::class;
                $resultat['elementTypeClasse'] =  ElemTitreType::class;
            break;
            default:
                $demandeur = 'demandeurDeElement';
                $this->setRedirect('admin_choisir');
                $this->addParamRedirect('demandeur', $demandeur);
                //Enregistrer les infos dans la session pour le retour ici après le traitement
                $this->sessionService->enregistrerVariable('choixPossibles', $this->preparerChoix(self::CHOIX_POSSIBLES));
                $this->sessionService->enregistrerVariable('nomDuChoix', 'elementName');
                $this->sessionService->enregistrerVariable('titre', $this->codeTrad('admin.visuel.elements.choisir'));
                $this->sessionService->enregistrerCheminActuel($demandeur);
            break;
        }
        return $resultat;
    }

    private function genererFormulaire($idvisuel, $elementName, $idelemxconteneur, $element = null): void
    {
        $elemXConteneur = $this->findById(ElemX::Class, $idelemxconteneur);
        $parametres = $this->recupererClasseElement($elementName);
        if($parametres != null)
        {
            if($element == null)
            {
                $element = $parametres['element'];
            }
            //Formulaire        
            $form = $this->createForm($parametres['elementTypeClasse'], $element);
            if($this->formIsValid($form))
            {
                $elemXConteneur->getElement()->addElement($element->getElemX());
                // //Avant de persister l'element, on lui donne une position si elle est à 0
                // if($element->getElemX()->getPosition() == 0)
                // {
                //     $position = sizeOf($element->getElemX()->getParent()->getElements());
                //     $element->getElemX()->setPosition($position);
                // }
                $this->manager->persist($element);
                $this->manager->persist($elemXConteneur);
                $this->manager->flush();
                $this->addFlash('success', 'admin.visuel.element.form.flash.success.'.$elementName);
                $this->redirectParentVisuel($idvisuel);                
            }
            //Affichage        
            $this->setTwig('pages/admin_visuel/page____admin_visuel____form_element.html.twig');
            $this->addParamTwig('form', $form->createView());
            $this->addParamTwig('elementName', $elementName);
        }        
    }    

    private function redirectParentVisuel($idvisuel)
    {
        $visuel = $this->findById(Visuel::class, $idvisuel);
        switch($visuel->getParentType())
        {
            case 'article' :
                $this->setRedirect('admin_article_gerer');
                $this->addParamRedirect('idarticle', $visuel->getParent()->getId());
            break;
            case 'organisme' :
                $this->setRedirect('admin_organisme_gerer');
                $this->addParamRedirect('idorganisme', $visuel->getParent()->getId());
            break;
        }
    }
}
