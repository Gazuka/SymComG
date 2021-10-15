<?php

namespace App\Controller;

use App\Entity\Poste\Poste;
use App\Form\Poste\PosteType;
use App\Controller\AdminController;
use App\Entity\Organisme\Organisme;
use App\Entity\CarteVisite\CarteVisite;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPosteController extends AdminController
{
    /**
     * PUBLIC : CREER - Permet de créer un nouveau poste
     * 
     * @Route("/admin/poste/creer/{idorganisme}", name="admin_poste_creer", requirements={"idorganisme"="\-?[0-9]+"})
     * @return Response
     */
    public function creerPoste($idorganisme): Response
    {
        $organisme = $this->FindById(Organisme::class, $idorganisme);
        $this->genererFormulaire($organisme);
        return $this->afficher('admin.poste.creer.titre');
    }

    /**
     * Utile en cas de redirection via la carte de visite du poste => redirige vers l'organisme du poste
     * @Route("/admin/poste/gerer/{idposte}", name="admin_poste_gerer", requirements={"idposte"="\-?[0-9]+"})
     * @return Response
     */
    public function gererPoste($idposte): Response
    {
        $poste = $this->FindById(Poste::class, $idposte);
        $this->setRedirect('admin_organisme_gerer');
        $this->addParamRedirect('idorganisme', $poste->getOrganisme()->getId());
        return $this->afficher();
    }

    /**
     * @Route("/admin/poste/joindre/profil/{idposte}", name="admin_poste_joindre_profil", requirements={"idposte"="\-?[0-9]+"})
     * @return Response
     */
    public function joindreProfil($idposte): Response
    {
        $poste = $this->findById(Poste::class, $idposte);
        //On enregistre dans la session pour pouvoir effectuer le choix puis le retour
        $this->sessionService->creerChemin('cheminJoindreProfil', 'admin_organisme_gerer', ['idorganisme' => $poste->getOrganisme()->getId()]);
        $configJoindreProfil =   [
                                    'idposte' => $idposte,
                                    'label' => 'admin.poste.joindre.profil.bouton.label'
                                ];
        $this->sessionService->enregistrerVariable('configJoindreProfil', $configJoindreProfil);
        $this->setRedirect('admin_profils');
        return $this->afficher();
    }

    /**
     * PRIVE : 
     * @return void
     */
    private function genererFormulaire($organisme, $poste = null): void
    {
        if($poste == null)
        {
            $poste = new Poste();
        }
        //Formulaire        
        $form = $this->createForm(PosteType::class, $poste);
        if($this->formIsValid($form))
        {
            if($poste->getOrganisme() == null)
            {
                $poste->setOrganisme($organisme);                                       
            }                                
            $this->manager->persist($poste);
            $this->manager->flush();
            $this->addFlash('success', 'admin.poste.form.flash.success');
            $this->setRedirect('admin_organisme_gerer');
            $this->addParamRedirect('idorganisme', $organisme->getId());
        }
        //Affichage        
        $this->setTwig('pages/admin_poste/page____admin_poste____poste____form.html.twig');
        $this->addParamTwig('form', $form->createView());  
    }  

    /**
     * PUBLIC : ATTACHER CarteVisite - Créer une nouvelle carte de visite vierge
     * 
     * @Route("/admin/poste/cartevisite/{idposte}", name="admin_poste_cartevisite", requirements={"idposte"="\-?[0-9]+"})
     * @param integer $idposte
     * @return Response
     */
    public function attacherCarteVisite(int $idposte):Response
    {
        //Récupérer du poste
        $poste = $this->findById(Poste::class, $idposte);
        //Créer et attacher la carte de visite
        $carteVisite = new CarteVisite();
        $poste->setCarteVisite($carteVisite);
        $this->manager->persist($poste);
        $this->manager->flush();
        $this->setRedirect('admin_organisme_gerer');
        $this->addParamRedirect('idorganisme', $poste->getOrganisme()->getId());
        return $this->afficher();
    }
}
