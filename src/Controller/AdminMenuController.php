<?php

namespace App\Controller;

use App\Entity\Menu\Lien;
use App\Form\Menu\LienType;
use App\Controller\AdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminMenuController extends AdminController
{
    /**
     * @Route("/admin/menu", name="admin_menu")
     */
    public function index(): Response
    {
        return $this->render('admin_menu/index.html.twig', [
            'controller_name' => 'AdminMenuController',
        ]);
    }

    /**
     * PUBLIC : CREER - Permet de créer un nouveau lien
     * 
     * @Route("/admin/menu/lien/gerer/{idlien}", name="admin_menu_lien_gerer", requirements={"idlien"="\-?[0-9]+"})
     * @param integer $idlien
     * @return Response
     */
    public function gererLien(int $idlien): Response
    {
        //Récupérer le lien
        $lien = $this->findById(Lien::class, $idlien);
        //Afficher le formulaire
        $this->genererFormulaire($lien);        
        return $this->afficher("TRAD : Gestion d'un lien");        
    }

    /**
     * PRIVE : GENERER - Génère un formulaire
     * @param object $lien //Objet qui sera édité
     * @return void
     */
    private function genererFormulaire($lien): void
    {
        $form = $this->createForm(LienType::class, $lien);
        if($this->formIsValid($form))
        {
            $this->manager->persist($lien);
            $this->manager->flush();
            $this->addFlash('success', 'admin.menu.lien.form.flash.success');
            //On redirige vers le chemin spécifié précédemment  
            //$this->redirectViaChemin($this->classeurService->recupChemin($nomAvis));
            $this->redirectViaSession('attacherLienOrganisme');
        }
        else
        {
            //Affichage du formulaire
            $this->setTwig('pages/admin_menu/page____admin_menu____lien____form.html.twig');
            $this->addParamTwig('form', $form->createView());                
        }
    } 
}
