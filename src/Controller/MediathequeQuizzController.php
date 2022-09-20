<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Classes\Question;

class MediathequeQuizzController extends SymComGController
{
    /**
     * @Route("/mediatheque/quizz", name="mediatheque_quizz")
     */
    public function index(): Response
    {
        $this->setTwig('pages/mediatheque_quizz/page____mediatheque_quizz.html.twig');

        $questions = array();

        //Question 1
        $q1 = new Question();
        $q1->setId(1);
        $q1->setTitre("Test n°1");
        $q1->setSsTitre('Classement par ordre alphabétique');
        $q1->setSolution('bibliothecaire');
        $this->lireReponse($q1);          
        array_push($questions, $q1);

        //Question 2
        $q2 = new Question();
        $q2->setId(2);
        $q2->setTitre("Test n°2");
        $q2->setSsTitre('La boulette à ne pas faire...');
        $q2->setSolution('bravo');
        $this->lireReponse($q2);          
        array_push($questions, $q2);
        
        //Transfert des questions au Twig
        $this->addParamTwig('questions', $questions);

        return $this->afficher();
    }

    private function lireReponse($question)
    {
        if(isset($_POST[$question->getId()]))
        {
            $question->setReponse(strtolower($_POST[$question->getId()]));   
        } 
    }
}