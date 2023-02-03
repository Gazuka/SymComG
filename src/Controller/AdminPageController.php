<?php

//N'est pas utilisé pour le moment...

namespace App\Controller;

use App\Entity\Page;
use App\Entity\Module;
use App\Form\PageType;
use App\Entity\Contenu;
use App\Entity\ElementParagraphe;
use App\Controller\AdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPageController extends AdminController
{
    /**
     * PUBLIC : CREER
     * 
     * @Route("/admin/page/creer", name="admin_page_creer")
     * @return Response
     */
    public function creerPage(): Response
    {
        $page = new Page();
        $this->genererFormulairePage($page);
        $this->setTitre('TRAD:creer une page');
        return $this->afficher();  
    }

    /**
     * PUBLIC : EDITER
     * @Route("/admin/page/editer/{idpage}", name="admin_page_editer", requirements={"idpage"="\-?[0-9]+"})
     * @param integer $idpage
     * @return Response
     */
    public function editerPage(int $idpage):Response
    {
        //Récupérer la page
        $page = $this->findById(Page::class, $idpage);
        $this->genererFormulairePage($page);
        $this->setTitre('TRAD:editer une page');
        return $this->afficher();
    }

    /**
     * PUBLIC : CREER contenu
     * @Route("/admin/page/contenu/creer/{idpage}", name="admin_page_contenu_creer", requirements={"idpage"="\-?[0-9]+"})
     * @param integer $idpage
     * @return Response
     */
    public function creerContenu(int $idpage):Response
    {
        //Récupérer la page
        $page = $this->findById(Page::class, $idpage);
        //Créer le contenu
        $contenu = new Contenu();
        $contenu->setPosition(sizeOf($page->getContenus())+1);
        $contenu->setPage($page);
        //On enregistre l'objet contenu
        $this->manager->persist($contenu);
        $this->manager->flush();
        //On redirige (vers la création du contenu / vers la page pour tester)
        $this->setRedirect('admin_page_previsualiser');
        $this->addParamRedirect('idpage', $page->getId());
        $this->setTitre('TRAD:creation de contenu');
        return $this->afficher();
    }

    /**
     * PUBLIC : PREVISUALISER une page pour gérer ses composants
     * @Route("/admin/page/previsualiser/{idpage}", name="admin_page_previsualiser", requirements={"idpage"="\-?[0-9]+"})
     * @param integer $idpage
     * @return Response
     */
    public function previsualiserPage(int $idpage):Response
    {
        //Récupérer la page
        $page = $this->findById(Page::class, $idpage);
        $this->setTitre('TRAD:previsualiser une page');
        $this->setTwig('pages/admin/pages/page_previsualiser.html.twig');
        $this->addParamTwig('page', $page);  
        return $this->afficher();
    }

    /**
     * PRIVE : Formulaire     
     */
    private function genererFormulairePage($page)
    {
        $form = $this->createForm(PageType::class, $page);
        if($this->formIsValid($form))
        {
            $this->manager->persist($page);
            $this->manager->flush();
            // $this->addFlash('success', 'Le service '.$service->getNom()." a bien été créé !");
            $this->setRedirect('admin');
        }
        //Affichage        
        $this->setTwig('pages/admin/pages/form_page.html.twig');
        $this->addParamTwig('form', $form->createView());  
    }

    /**
     * PUBLIC : TEST ------------------------------------
     * 
     * @Route("/admin/page/tester", name="admin_page_tester")
     * @return Response
     */
    public function testerPage(): Response
    {
        $page = new Page();
        $page->setNom('Ma page de test');
        $page->setTitre('Le titre de ma page');        
        $paragraphe = new ElementParagraphe();
        $paragraphe->setTexte("Hello world !");

        $module = new Module();
        $module->setElementParagraphe($paragraphe);

        $contenu = new Contenu();
        $contenu->setModule($module);
        // $contenu->setPosition(1);

        $page->addContenu($contenu);

        //Affichage        
        $this->setTwig('pages/admin/pages/page_voir.html.twig');
        $this->addParamTwig('page', $page);  
        $this->setTitre('TRAD:titre');
        return $this->afficher();  


        // $element = new ElementParagraphe();
        // $element->setTexte("Hello world !");
        // $element->setTwig('partials/elements/entity/__element_paragraphe.html.twig');
        // $element->retournerParametres();
    }
}
