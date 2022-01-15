<?php

namespace App\Controller;

use App\Entity\Annonce\Annonce;
use App\Form\Annonce\AnnonceType;
use App\Controller\AdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAnnonceController extends AdminController
{
    /**
     * Page de création d'une nouvelle annonce
     * 
     * @Route("/admin/annonce/creer", name="admin_annonce_creer")
     * @return Response
     */
    public function creerAnnonce(): Response
    {
        $this->genererFormulaire();
        //Affichage
        return $this->afficher('admin.annonce.creer.titre');
    }

    /**
     * Page qui affiche l'ensemble des annonces
     * 
     * @Route("/admin/annonces", name="admin_annonces_voir")
     * @return Response
     */
    public function voirAnnonces(): Response
    {
        //Récupérer toutes les annonces
        $annonces = $this->findAll(Annonce::class);
        //Affichage            
        $this->setTwig('pages/admin_annonce/page____admin_annonce____annonces____voir.html.twig');
        $this->addParamTwig('annonces', $annonces);
        return $this->afficher('admin.annonces.voir.titre.');
    }

    /**
     * PUBLIC : EDITER - Editer une annonce
     * @Route("/admin/annonce/editer/{idannonce}", name="admin_annonce_editer", requirements={"idannonce"="\-?[0-9]+"})
     * @param integer $idannonce
     * @return Response
     */
    public function editerAnnonce(int $idannonce):Response
    {
        //Récupérer l'annonce
        $annonce = $this->findById(Annonce::class, $idannonce);
        $this->genererFormulaire($annonce);
        return $this->afficher('admin.annonce.editer.titre.'.$annonce->getTitre());
    }

    /**
     * Création d'un formulaire d'annonce
     */
    private function genererFormulaire(Annonce $annonce=null): void
    {
        if($annonce == null)
        {
            $annonce = new Annonce();
        }
        //Formulaire        
        $form = $this->createForm(AnnonceType::class, $annonce);
        if($this->formIsValid($form))
        {
            $this->manager->persist($annonce);
            $this->manager->flush();
            $this->addFlash('success', 'admin.annonce.form.flash.success');
            $this->setRedirect('admin_accueil');////////////////////////DEBUG : mettre gestion des lieux
        }
        //Affichage        
        $this->setTwig('pages/admin_annonce/page____admin_annonce____annonce____form.html.twig');
        $this->addParamTwig('form', $form->createView());        
    }
}
