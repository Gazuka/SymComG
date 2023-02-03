<?php

namespace App\Controller;

use App\Entity\Agenda\Evenement;
use App\Form\Agenda\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAgendaController extends AdminController
{
    public const CONTROLLER_NAME = 'admin_agenda';
    public const CLASS_OBJET = Evenement::class;
    public const CLASS_FORM = EvenementType::class;   
    public const NAMESPACE_OBJET = 'App\\Entity\\Agenda\\Evenement';    
    public const OBJETS_NAME = 'evenements';
    public const OBJET_NAME = 'evenement';

    /**
     * Afficher l'ensemble des événements
     * 
     * @Route("/admin/evenements", name="admin_evenements_voir")
     * @return Response
     */
    public function voirEvenements(): Response
    {
        return $this->voirTout();
    }

    /**
     * Page permettant la création d'un nouvel évènement
     * 
     * @Route("/admin/evenement/creer", name="admin_evenement_creer")
     * @return Response
     */
    public function creerEvenement(): Response
    {
        $this->creerFormulaire('admin_evenements_voir', null); //DEBUG : mettre admin_evenement_voir        
        return $this->creerObjet();
    }

    /**
     * @Route("/admin/evenement/gerer/{idevenement}", name="admin_evenement_gerer", requirements={"idevenement"="\-?[0-9]+"})
     * @return Response
     */
    public function gererEvenement($idevenement): Response
    {
        $this->twigAjoutMedia('evenement', 'gerer_evenement');        
        return $this->gererObjet($idevenement, 'admin_evenement_gerer');
    }

    /**
     * Page qui permet de joindre un Média à l'événement
     * 
     * @Route("/admin/agenda/evenement/classeur/joindre/{idevenement}/{typeName}", name="admin_evenement_ajouter_media", requirements={"idevenement"="\-?[0-9]+"})
     * @param integer $idevenement
     * @return Response
     */
    public function joindreMedia(int $idevenement, string $typeName): Response
    {
        //Affichage        
        return $this->ajouterMedia($idevenement, $typeName);
    }
}