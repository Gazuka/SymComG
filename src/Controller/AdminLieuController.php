<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Form\LieuType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminLieuController extends AdminController
{
    /**
     * Page de création d'un nouveau lieu
     * 
     * @Route("/admin/lieu/creer", name="admin_lieu_creer")
     * @return Response
     */
    public function creerLieu(): Response
    {
        $this->genererFormulaire();
        //Affichage
        return $this->afficher('admin.lieu.creer.titre');
    }

    /**
     * Page qui affiche l'ensemble des lieux
     * 
     * @Route("/admin/lieux", name="admin_lieux_voir")
     * @return Response
     */
    public function voirLieux(): Response
    {
        //Récupérer tous les lieux
        $lieux = $this->findAll(Lieu::class);
        //Affichage            
        $this->setTwig('pages/admin_lieu/page____admin_lieu____lieux____voir.html.twig');
        $this->addParamTwig('lieux', $lieux);
        return $this->afficher('admin.lieux.voir.titre.');
    }

    /**
     * Création d'un formulaire de lieu
     *
     * @param Lieu|null $lieu
     * @return void
     */
    private function genererFormulaire(Lieu $lieu=null): void
    {
        if($lieu == null)
        {
            $lieu = new Lieu();
        }
        //Formulaire        
        $form = $this->createForm(LieuType::class, $lieu);
        if($this->formIsValid($form))
        {
            $this->manager->persist($lieu);
            $this->manager->flush();
            $this->addFlash('success', 'admin.lieu.form.flash.success');
            $this->setRedirect('admin_accueil');////////////////////////DEBUG : mettre gestion des lieux
        }
        //Affichage        
        $this->setTwig('pages/admin_lieu/page____admin_lieu____lieu____form.html.twig');
        $this->addParamTwig('form', $form->createView());        
    }
}
