<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Classeur\Classeur;
use App\Entity\Classeur\Format\Image\Affiche;
use App\Entity\Agenda\Evenement;
use App\Entity\Organisme\Organisme;
use App\Entity\TypePublic;

class MediathequeAccueilController extends SymComGController
{
    private $idOrganismeMediatheque = 30;

    /**
     * @Route("/mediatheque/accueil", name="mediatheque_accueil")
     */
    public function index(): Response
    {
        // --- Appel de la page d'accueil ---
        $this->setTwig('pages/mediatheque_accueil/page____mediatheque_accueil.html.twig');

        // --- Affichage du panneau d'affichage (classeur avec toutes les affiches)
        $classeurAffiches = $this->recupererClasseurAffiches();  
        $this->addParamTwig('classeurAffiches', $classeurAffiches);

        $this->recupererEvenements();
        
        return $this->afficher();
    }


    //==================
    // --- FONCTIONS DEBUG : Copie des fonctions de SiteController voir pour les utiliser directement---
    //==================
    private function recupererClasseurAffiches()
    {
        // On récupère toutes les affiches (DEBUG : ne prendre que celles qui sont d'actualité par la suite)
        $affiches = $this->manager->getRepository(Affiche::class)->findActuelles();        
        // On crée le classeur et on lui donne toutes les affiches
        $classeurAffiches = new Classeur();
        foreach($affiches as $affiche)
        {
            $classeurAffiches->addDocument($affiche->getSupport()->getMedia()->getDocument());
        }
        return $classeurAffiches;
    }

    private function recupererEvenements()
    {
        $organisme = $this->findById(Organisme::class, $this->idOrganismeMediatheque);
        // --- Affichage de l'agenda ---
        $evenements = $this->manager->getRepository(Evenement::class)->findProchainsOrganisme($this->idOrganismeMediatheque, 100);
        $this->addParamTwig('evenements', $evenements);
        $evenementsPrincipaux = $this->manager->getRepository(Evenement::class)->findPrincipauxOrganisme($this->idOrganismeMediatheque);
        $this->addParamTwig('evenementsPrincipaux', $evenementsPrincipaux);
        // --- Affichage de la légende ---
        $legende = $this->findAll(TypePublic::class);
        $this->addParamTwig('legende', $legende);
    }
}
