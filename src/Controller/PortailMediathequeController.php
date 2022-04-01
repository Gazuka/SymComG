<?php

namespace App\Controller;

use App\Entity\TypePublic;
use App\Entity\Agenda\Evenement;
use App\Entity\Organisme\Organisme;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PortailMediathequeController extends SymComGController
{
    private $idOrganismeMediatheque = 30;

     /**
     * @Route("/portail/mediatheque/evenements", name="portail_mediatheque_evenements")
     */
    public function voirAgendaMediatheque(): Response
    {
        // --- Appel de la page d'agenda ---
        $this->setTwig('pages/portail_mediatheque/page____portail_mediatheque____evenements.html.twig');

        $organisme = $this->findById(Organisme::class, $this->idOrganismeMediatheque);
        // --- Affichage de l'agenda ---
        $evenements = $this->manager->getRepository(Evenement::class)->findProchainsOrganisme($this->idOrganismeMediatheque, 100);
        $this->addParamTwig('evenements', $evenements);
        $evenementsPrincipaux = $this->manager->getRepository(Evenement::class)->findPrincipauxOrganisme($this->idOrganismeMediatheque);
        $this->addParamTwig('evenementsPrincipaux', $evenementsPrincipaux);
        // --- Affichage de la légende ---
        $legende = $this->findAll(TypePublic::class);
        $this->addParamTwig('legende', $legende);
        return $this->afficher();
    }

    /**
     * @Route("/portail/mediatheque/evenement/{idevenement}", name="portail_mediatheque_evenement", requirements={"idevenement"="\-?[0-9]+"})
     */
    public function voirEvenement($idevenement): Response
    {
        $evenement = $this->findById(Evenement::class, $idevenement);
        $this->setTwig('pages/portail_mediatheque/page____portail_mediatheque____evenement.html.twig');
        $this->addParamTwig('evenement', $evenement);
        return $this->afficher();
    }
}
