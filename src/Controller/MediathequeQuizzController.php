<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Classes\Chemin;

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
        $q1->setSsTitre('mon ss titre');        
        array_push($questions, $q1);
        
        //Traitement des questions
        foreach($questions as $question)
        {
            $this->gestionQuestion($question);
        }

        return $this->afficher();
    }

    private function gestionChamp(Question $question)
    {
        $idChamp = 'jeu_'.$numQuestion;
        $nomReponse = 'rep_'.$numQuestion;
        $nomCorrection = 'cor_'.$numQuestion;

        $correction = null;
        if (isset($_POST[$idChamp]))
        {
            $reponse = strtolower($_POST[$idChamp]);
            if($reponse == 'bravo')
            {
                $correction = true;
            }
            else
            {
                if($reponse == "")
                {
                    $correction = null;
                }
                else
                {
                    $correction = false;
                }
            }                        
        }
        else
        {
            $reponse = null;
        }

        $this->addParamTwig($nomReponse, $reponse);       
        $this->addParamTwig($nomCorrection, $correction); 
    }
}
