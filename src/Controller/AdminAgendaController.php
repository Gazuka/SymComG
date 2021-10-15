<?php

namespace App\Controller;

use App\Entity\Agenda\Evenement;
use App\Form\Agenda\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAgendaController extends AdminController
{
    /**
     * PUBLIC : Gestion des évènements
     * 
     * @Route("/admin/evenements", name="admin_evenements")
     * @return Response
     */
    public function gererEvenements(): Response
    {
        // DEBUG--------------------------------------------------------------------------------------PAS FONCTIONNEL, A FAIRE COMPLETEMENT
        //Affichage
        $this->setTwig('pages/admin_agenda/page____admin_agenda____evenements____gerer.html.twig');
        $this->addParamTwig('sousTitre', 'admin.evenements.gerer.titre');
        return $this->afficher('admin.profil.interface.titre');
    }

    /**
     * Page permettant la création d'un nouvel évènement
     * 
     * @Route("/admin/evenement/creer", name="admin_evenement_creer")
     * @return Response
     */
    public function creerEvenement(): Response
    {
        $this->genererFormulaire();
        //Affichage
        return $this->afficher('admin.evenement.creer.titre');
    }



    private function genererFormulaire(Evenement $evenement=null): void
    {
        if($evenement == null)
        {
            $evenement = new Evenement();
        }
        //Formulaire        
        $form = $this->createForm(EvenementType::class, $evenement);
        if($this->formIsValid($form))
        {
            $this->manager->persist($evenement);
            $this->manager->flush();
            $this->addFlash('success', 'admin.evenement.form.flash.success');
            $this->setRedirect('admin_profils');////////////////////////DEBUG : mettre admin_evenement_voir
        }
        //Affichage        
        $this->setTwig('pages/admin_agenda/page____admin_agenda____evenement____form.html.twig');
        $this->addParamTwig('form', $form->createView());        
    }
}
