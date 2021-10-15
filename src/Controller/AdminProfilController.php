<?php

namespace App\Controller;

use App\Entity\Poste\Poste;
use App\Entity\Profil\Profil;
use App\Form\Profil\ProfilType;
use App\Entity\CarteVisite\CarteVisite;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminProfilController extends AdminController
{
    /**
     * PUBLIC : Gestion des profils
     * 
     * @Route("/admin/profils", name="admin_profils")
     * @return Response
     */
    public function gererProfils(): Response
    {
        $this->initialiserGestionnaire();
        //Affichage
        $this->setTwig('pages/admin_profil/page____admin_profil____profils____gerer.html.twig');
        $this->addParamTwig('sousTitre', 'admin.profils.gerer.titre');
        return $this->afficher('admin.profil.interface.titre');
    }

    /**
     * Page permettant la création d'un nouveau profil
     * 
     * @Route("/admin/profil/creer", name="admin_profil_creer")
     * @return Response
     */
    public function creerProfil(): Response
    {
        $this->initialiserGestionnaire();
        $this->genererFormulaire();
        //Affichage
        $this->addParamTwig('sousTitre', 'admin.profil.creer.titre');
        return $this->afficher('admin.profil.interface.titre');
    }

    /**
     * Page permettant l'affichage d'un profil
     * 
     * @Route("/admin/profil/gerer/{idprofil}", name="admin_profil_gerer", requirements={"idprofil"="\-?[0-9]+"})
     * @return Response
     */
    public function gererProfil($idprofil): Response
    {
        $this->initialiserGestionnaire();
        $profil = $this->findById(Profil::class, $idprofil);
        //Affichage
        $this->setTwig('pages/admin_profil/page____admin_profil____profil____gerer.html.twig');
        $this->addParamTwig('sousTitre', 'admin.profil.gerer.titre');
        $this->addParamTwig('profil', $profil);
        $this->addParamTwig('ajout_media', $this->classeurService->recupAjoutMedia('profil'));
        return $this->afficher('admin.profil.interface.titre');
    }

    private function initialiserGestionnaire()
    {
        $profils = $this->findAll(Profil::class);
        $this->addParamTwig('profils', $profils);
    }

    private function genererFormulaire(Profil $profil=null): void
    {
        if($profil == null)
        {
            $profil = new Profil();
        }
        //Formulaire        
        $form = $this->createForm(ProfilType::class, $profil);
        if($this->formIsValid($form))
        {
            $this->manager->persist($profil);
            $this->manager->flush();
            $this->addFlash('success', 'admin.profil.form.flash.success');
            $this->setRedirect('admin_profils');////////////////////////DEBUG : mettre admin_profil_voir
        }
        //Affichage        
        $this->setTwig('pages/admin_profil/page____admin_profil____profil____form.html.twig');
        $this->addParamTwig('form', $form->createView());        
    }

    /**
     * PUBLIC : Ajouter un profil dans un poste puis rediriger vers le parent actif
     * 
     * @Route("/admin/profil/ajout/poste/{idposte}/{idprofil}", name="admin_profil_ajouter_poste", requirements={"idprofil"="\-?[0-9]+", "idposte"="\-?[0-9]+"})
     * @return Response
     */
    public function ajouterProfilAuPoste($idposte, $idprofil): Response
    {
        $poste = $this->repoService->findById(Poste::class, $idposte);
        $profil = $this->repoService->findById(Profil::class, $idprofil);
        $profil->addPoste($poste);
        $this->manager->persist($profil);
        $this->manager->flush();
        $this->addFlash('success', 'admin.profil.ajout.poste.flash.success');
        //On redirige vers le chemin spécifié précédemment
        $this->redirectViaSession('cheminJoindreProfil');
        //On supprime les variables de la session
        $this->sessionService->supprimerVariable('configJoindreProfil');        
        return $this->afficher();
    }

    /**
     * PUBLIC : ATTACHER CarteVisite - Créer une nouvelle carte de visite vierge
     * 
     * @Route("/admin/profil/cartevisite/{idprofil}", name="admin_profil_cartevisite", requirements={"idprofil"="\-?[0-9]+"})
     * @param integer $idprofil
     * @return Response
     */
    public function attacherCarteVisite(int $idprofil):Response
    {
        //Récupérer du profil
        $profil = $this->findById(Profil::class, $idprofil);
        //Créer et attacher la carte de visite
        $carteVisite = new CarteVisite();
        $profil->setCarteVisite($carteVisite);
        $this->manager->persist($profil);
        $this->manager->flush();
        $this->setRedirect('admin_profil_gerer');
        $this->addParamRedirect('idprofil', $profil->getId());
        return $this->afficher();
    }

    /**
     * PUBLIC : Ajouter un Média
     * 
     * @Route("/admin/profil/classeur/joindre/{idprofil}/{typeName}", name="admin_profil_ajouter_media", requirements={"idprofil"="\-?[0-9]+"})
     * @param integer $idprofil
     * @return Response
     */
    public function addMedia(int $idprofil, string $typeName): Response
    {
        //Récupérer le profil
        $profil = $this->findById(Profil::class, $idprofil);
        //Récupérer ou créer le classeur selon le type et l'enregistrer
        $classeur = $this->classeurService->recupererLeBonClasseur($profil, $typeName);
        $this->manager->persist($classeur);
        $this->manager->flush();
        
        //Création d'un avisRechecheDocument
        $nomAvis = 'profil';
        $this->classeurService->creerAvisRechercheDocument($nomAvis, $profil, $classeur, 'admin.profil.joindre.media.bouton.label', $this->sessionService->recupChemin('cheminPrecedant'));
        $this->classeurService->recupMediasAutorises($nomAvis, 'profil', $typeName);
        $this->classeurService->enregistrerAvis($nomAvis);
        
        //Redirection vers la gestion des profils
        $this->setRedirect('admin_medias');
        //Affichage        
        return $this->afficher();
    }
}
