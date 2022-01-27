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
    const CONTROLLER_NAME = 'admin_annonce';
    const CLASS_OBJET = Annonce::class;
    const CLASS_FORM = AnnonceType::class;   
    const NAMESPACE_OBJET = 'App\\Entity\\Annonce\\Annonce';    
    const OBJETS_NAME = 'annonces';
    const OBJET_NAME = 'annonce';

    /**
     * Création d'une nouvelle annonce
     * 
     * @Route("/admin/annonce/creer", name="admin_annonce_creer")
     * @return Response
     */
    public function creerAnnonce(): Response
    {
        $this->creerFormulaire(null, 'admin_annonce_gerer');
        return $this->creerObjet();
    }

    /**
     * Page qui affiche l'ensemble des annonces
     * 
     * @Route("/admin/annonces", name="admin_annonces_voir")
     * @return Response
     */
    public function voirAnnonces(): Response
    {
        return $this->voirTout();
    }

    /**
     * PUBLIC : EDITER - Editer une annonce
     * @Route("/admin/annonce/editer/{idannonce}", name="admin_annonce_gerer", requirements={"idannonce"="\-?[0-9]+"})
     * @param integer $idannonce
     * @return Response
     */
    public function gererAnnonce(int $idannonce):Response
    {
        return $this->gererObjet($idannonce, 'admin_annonce_gerer');
        //Récupérer l'annonce
        // $annonce = $this->findById(Annonce::class, $idannonce);
        // $this->genererFormulaire($annonce);
        // return $this->afficher('admin.annonce.editer.titre.'.$annonce->getTitre());
    }    
}