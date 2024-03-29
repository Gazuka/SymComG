<?php

namespace App\Controller;

use App\Form\ArticleType;
use App\Entity\Visuel\Visuel;
use App\Entity\Article\Article;
use App\Entity\Agenda\Evenement;
use App\Controller\AdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class AdminArticleController extends AdminController
{
    public const CONTROLLER_NAME = 'admin_article';
    public const CLASS_OBJET = Article::class;
    public const CLASS_FORM = ArticleType::class;   
    public const NAMESPACE_OBJET = 'App\\Entity\\Article\\Article';    
    public const OBJETS_NAME = 'articles';
    public const OBJET_NAME = 'article';

    /**
     * Afficher l'ensemble des articles
     * @Route("/admin/articles", name="admin_articles_voir")
     * @return Response
     */
    public function voirArticles(): Response
    {
        return $this->voirTout();
    }

    /**
     * @Route("/admin/article/creer", name="admin_article_creer")
     * @return Response
     */
    public function creerArticle(): Response
    {
        $this->creerFormulaire('admin_article_gerer', null);
        return $this->creerObjet();
    }

    /**
     * @Route("/admin/article/evenement/creer/{idevenement}", name="admin_article_evenement_creer", requirements={"idevenement"="\-?[0-9]+"})
     * @return Response
     */
    public function creerArticlePrincipalEvenement($idevenement): Response
    {
        $evenement = $this->findById(Evenement::class, $idevenement);
        $article = $this->creerFormulaire('admin_article_gerer', null);
        // dump($article);
        if($article->getTitre() != null)
        {
            $article->addEvenementsPrincipaux($evenement);
        }
        return $this->creerObjet();
    }

    /**
     * @Route("/admin/article/gerer/{idarticle}", name="admin_article_gerer", requirements={"idarticle"="\-?[0-9]+"})
     * @return Response
     */
    public function gererArticle($idarticle): Response
    {
        $this->twigAjoutMedia('article', 'gerer_article');
        $this->gererObjet($idarticle, 'admin_article_gerer'); // Ligne à supprimer après résolution du pb
        return $this->gererObjet($idarticle, 'admin_article_gerer');
    }

    /**
     * PUBLIC : Ajouter un Média
     * 
     * @Route("/admin/article/classeur/joindre/{idarticle}/{typeName}", name="admin_article_ajouter_media", requirements={"idarticle"="\-?[0-9]+"})
     * @param integer $idarticle
     * @return Response
     */
    public function joindreMedia(int $idarticle, string $typeName): Response
    {
        //Affichage        
        return $this->ajouterMedia($idarticle, $typeName);
    }



    

    /**
     * @Route("/admin/article/ajouter/annexe/{idarticle}", name="admin_article_ajouter_annexe", requirements={"idarticle"="\-?[0-9]+"})
     * @return Response
     */
    public function ajouterAnnexe($idarticle): Response
    {
        $article = $this->findById(Article::class, $idarticle);
        $annexe = new Visuel();
        $article->setAnnexe($annexe);
        $this->manager->persist($article);
        $this->manager->flush();
        $this->setRedirect('admin_article_gerer');
        $this->addParamRedirect('idarticle', $idarticle);
        return $this->afficher();
    }   
}