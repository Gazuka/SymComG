<?php

namespace App\Controller;

use App\Entity\Composant;
use App\Entity\ComposantGenre;
use App\Entity\ComposantModele;
use App\Form\ComposantModeleType;
use App\Controller\AdminController;
use App\Entity\ComposantCaracteristique;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminComposantController extends AdminController
{
    /**
     * @Route("admin/composant/initialiser", name="admin_composant_initialiser")
     */
    public function initialiserComposant(): Response
    {
        //Initialisation des genres
        $genres = ['string', 'text', 'boolean', 'integer', 'float', 'array', 'object', 'datetime', 'date', 'time', 'dateinterval'];
        foreach($genres as $genre)
        {
            $composantGenre = new ComposantGenre();
            $composantGenre->setNom($genre);
            $this->manager->persist($composantGenre);
        }
        $this->manager->flush();
        return $this->render('composant/index.html.twig', [
            'controller_name' => 'ComposantController',
        ]);
    }

    /**
     * @Route("admin/composant/tester", name="admin_composant_tester")
     */
    public function testerComposant(): Response
    {
        $modele = $this->findById(ComposantModele::class, '3');
        $composant = new Composant();
        $composant->setModele($modele);
        dump($composant);
        dd('debug fin');
        return $this->render('composant/index.html.twig', [
            'controller_name' => 'ComposantController',
        ]);
    }

    /**
     * PUBLIC : CREER - Permet de créer un nouveau modèle de composant
     * 
     * @Route("/admin/composant/modele/creer", name="admin_composant_modele_creer")
     * @return Response
     */
    public function creerComposant(): Response
    {
        $composantModele = new ComposantModele();
        // $composantCaracteristique = new ComposantCaracteristique();
        // $composantCaracteristique->setTitre('Mon titre');
        // $composantModele->addCaracteristique($composantCaracteristique);
        // $composantCaracteristique2 = new ComposantCaracteristique();
        // $composantCaracteristique2->setTitre('Mon titre 2');
        // $composantModele->addCaracteristique($composantCaracteristique2);

        $form = $this->createForm(ComposantModeleType::class, $composantModele);
        if($this->formIsValid($form))
        {
            $this->manager->persist($composantModele);
            $this->manager->flush();
            // $this->addFlash('success', 'Le service '.$service->getNom()." a bien été créé !");
            $this->setRedirect('admin');
        }
        //Affichage        
        $this->setTwig('pages/admin/composants/form_composant_modele.html.twig');        
        $this->addParamTwig('form', $form->createView());


        $this->setTitre("TRAD: Création d'un composant");
        return $this->afficher();  
    }
}
