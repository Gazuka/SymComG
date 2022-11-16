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
        $q1->setSolution('bibliothécaire');
        $this->lireReponse($q1);          
        array_push($questions, $q1);

        //Question 2
        $q2 = new Question();
        $q2->setId(2);
        $q2->setTitre("Test n°2");
        $q2->setSsTitre('La boulette à ne pas faire...');
        $q2->setSolution('maladresse');
        $this->lireReponse($q2);          
        array_push($questions, $q2);

        //Question 3
        $q3 = new Question();
        $q3->setId(3);
        $q3->setTitre("Test n°3");
        $q3->setSsTitre('Reconnaître les signopaginophiles');
        $q3->setSolution('corne');
        $this->lireReponse($q3);          
        array_push($questions, $q3);

        //Question 4
        $q4 = new Question();
        $q4->setId(4);
        $q4->setTitre("Test n°4");
        $q4->setSsTitre('Le moindre petit détail');
        $q4->setSolution('dessinateur');
        $this->lireReponse($q4);          
        array_push($questions, $q4);

        //Question 5
        $q5 = new Question();
        $q5->setId(5);
        $q5->setTitre("Test n°5");
        $q5->setSsTitre('Une aiguille dans une botte de foin');
        $q5->setSolution('archiviste');
        $this->lireReponse($q5);          
        array_push($questions, $q5);

        //Question 6
        $q6 = new Question();
        $q6->setId(6);
        $q6->setTitre("Test n°6");
        $q6->setSsTitre('Le diable est dans les détails');
        $q6->setSolution('vocabulaire');
        $this->lireReponse($q6);          
        array_push($questions, $q6);

        //Question 7
        $q7 = new Question();
        $q7->setId(7);
        $q7->setTitre("Test n°7");
        $q7->setSsTitre('Avoir les connaissances qu\'un Juke-Box');
        $q7->setSolution('violoncelles');
        $this->lireReponse($q7);
        array_push($questions, $q7);

        //Question 8
        $q8 = new Question();
        $q8->setId(8);
        $q8->setTitre("Test n°8");
        $q8->setSsTitre('Préparer une table thématique');
        $q8->setSolution('cousons');
        $this->lireReponse($q8);          
        array_push($questions, $q8);

        //Question 9
        $q9 = new Question();
        $q9->setId(9);
        $q9->setTitre("Test n°9");
        $q9->setSsTitre('Trouver le point commun');
        $q9->setSolution('pseudonyme');
        $this->lireReponse($q9);          
        array_push($questions, $q9);

        //Question 10
        $q10 = new Question();
        $q10->setId(10);
        $q10->setTitre("Test n°10");
        $q10->setSsTitre('La douchette');
        $q10->setSolution('marchande');
        $this->lireReponse($q10);          
        array_push($questions, $q10);

        //Question 11
        $q11 = new Question();
        $q11->setId(11);
        $q11->setTitre("Test n°11");
        $q11->setSsTitre('Le chaînon manquant');
        $q11->setSolution('roman');
        $this->lireReponse($q11);          
        array_push($questions, $q11);

        //Question 12
        $q12 = new Question();
        $q12->setId(12);
        $q12->setTitre("Test n°12");
        $q12->setSsTitre('Activité manuelle');
        $q12->setSolution('créatif');
        $this->lireReponse($q12);          
        array_push($questions, $q12);

        //Question 13
        $q13 = new Question();
        $q13->setId(13);
        $q13->setTitre("Test n°13");
        $q13->setSsTitre('Trouver la source');
        $q13->setSolution('xavier');
        $this->lireReponse($q13);          
        array_push($questions, $q13);

        //Question 14
        $q14 = new Question();
        $q14->setId(14);
        $q14->setTitre("Test n°14");
        $q14->setSsTitre('Recherche dans la vidéothèque');
        $q14->setSolution('cinéphile');
        $this->lireReponse($q14);          
        array_push($questions, $q14);

        //Question 15
        $q15 = new Question();
        $q15->setId(15);
        $q15->setTitre("Test n°15");
        $q15->setSsTitre('Mots codés');
        $q15->setSolution('livre');
        $this->lireReponse($q15);          
        array_push($questions, $q15);

        //Question 16
        $q16 = new Question();
        $q16->setId(16);
        $q16->setTitre("Test n°16");
        $q16->setSsTitre('Certains préfèrent les bulles');
        $q16->setSolution('dessinatrice');
        $this->lireReponse($q16);          
        array_push($questions, $q16);

        //Question 17
        $q17 = new Question();
        $q17->setId(17);
        $q17->setTitre("Test n°17");
        $q17->setSsTitre('Une description approximative');
        $q17->setSolution('folio');
        $this->lireReponse($q17);          
        array_push($questions, $q17);

        //Question 18
        $q18 = new Question();
        $q18->setId(18);
        $q18->setTitre("Test n°18");
        $q18->setSsTitre('Le conte est bon');
        $q18->setSolution('alphabétisation');
        $this->lireReponse($q18);          
        array_push($questions, $q18);

        //Question 19
        $q19 = new Question();
        $q19->setId(19);
        $q19->setTitre("Test n°19");
        $q19->setSsTitre('Un âge pour tout');
        $q19->setSolution('vigilance');
        $this->lireReponse($q19);          
        array_push($questions, $q19);

        //Question 20
        $q20 = new Question();
        $q20->setId(20);
        $q20->setTitre("Test n°20");
        $q20->setSsTitre('Les dessous de la Médiathèque');
        $q20->setSolution('cachotteries');
        $this->lireReponse($q20);          
        array_push($questions, $q20);

        //Transfert des questions au Twig
        $this->addParamTwig('questions', $questions);

        return $this->afficher();
    }

    private function lireReponse($question)
    {
        if(isset($_POST[$question->getId()]))
        {
            $question->setReponse($_POST[$question->getId()]);   
        } 
    }
}