<?php

namespace App\Controller;

use App\Entity\Quizz\QuizzBanquet;
use App\Form\Quizz\QuizzBanquetType;
use App\Controller\SymComGController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteQuizzController extends SymComGController
{
    /**
     * @Route("/site/formulaire/banquet", name="site_quizz_banquet")
     */
    public function quizzBanquet(): Response
    {
        $quizzBanquet = new QuizzBanquet();
        //Formulaire        
        $form = $this->createForm(QuizzBanquetType::class, $quizzBanquet);
        if($this->formIsValid($form))
        {
            $this->manager->persist($quizzBanquet);
            $this->manager->flush();
            $this->addFlash('success', 'Votre préinscription est bien enregistré.');
            // $this->setRedirect('site_accueil');
            $this->addParamTwig('accuseDeReception', $quizzBanquet);    
        }
        //Affichage        
        $this->setTwig('pages/site_quizz/page____site_quizz____banquet.html.twig');
        $this->addParamTwig('form', $form->createView());
        
        return $this->afficher();
    }
}