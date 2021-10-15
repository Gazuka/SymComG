<?php

namespace App\Controller;

use App\Form\ArticleType;
use App\Entity\Visuel\Visuel;
use App\Entity\Article\Article;
use App\Controller\AdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class AdminArticleController extends AdminController
{
    /**
     * PUBLIC : VOIR - Afficher l'ensemble des articles
     * 
     * @Route("/admin/articles", name="admin_articles_voir")
     * @return Response
     */
    public function voirArticles(): Response
    {
        //Récupérer tous les articles
        $articles = $this->findAll(Article::class);
        //Affichage            
        $this->setTwig('pages/admin_article/page____admin_article____articles____voir.html.twig');
        $this->addParamTwig('articles', $articles);
        
        return $this->afficher('admin.articles.voir.titre');
    }


    /**
     * @Route("/admin/article/gerer/{idarticle}", name="admin_article_gerer", requirements={"idarticle"="\-?[0-9]+"})
     * @return Response
     */
    public function gererArticle($idarticle): Response
    {
        $article = $this->findById(Article::class, $idarticle);
        $this->genererFormulaire($article);
        $this->setTwig('pages/admin_article/page____admin_article____article____gerer.html.twig');
        $this->addParamTwig('article', $article);
        $this->addParamTwig('sessionService', $this->sessionService);
        $this->addParamTwig('ajout_media', $this->classeurService->recupAjoutMedia('article'));
        $this->sessionService->enregistrerCheminActuel('gerer_article');
        return $this->afficher('admin.article.gerer.titre');
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
    
    /**
     * @Route("/admin/article/creer", name="admin_article_creer")
     * @return Response
     */
    public function creerArticle(): Response
    {
        $this->genererFormulaire();
        return $this->afficher('admin.article.creer.titre');
    }

    /**
     * PUBLIC : Ajouter un Média
     * 
     * @Route("/admin/article/classeur/joindre/{idarticle}/{typeName}", name="admin_article_ajouter_media", requirements={"idarticle"="\-?[0-9]+"})
     * @param integer $idarticle
     * @return Response
     */
    public function addMedia(int $idarticle, string $typeName): Response
    {
        //Récupérer l'article
        $article = $this->findById(Article::class, $idarticle);
        //Récupérer ou créer le classeur selon le type et l'enregistrer
        $classeur = $this->classeurService->recupererLeBonClasseur($article, $typeName);
        $this->manager->persist($classeur);
        $this->manager->flush();
        
        //Création d'un avisRechecheDocument
        $nomAvis = 'article';
        $this->classeurService->creerAvisRechercheDocument($nomAvis, $article, $classeur, 'admin.article.joindre.media.bouton.label', $this->sessionService->recupChemin('cheminPrecedant'));
        $this->classeurService->recupMediasAutorises($nomAvis, 'article', $typeName);
        $this->classeurService->enregistrerAvis($nomAvis);
        
        //Redirection vers la gestion des medias
        $this->setRedirect('admin_medias');
        //Affichage        
        return $this->afficher();
    }

    private function genererFormulaire($article = null): void
    {
        if($article == null)
        {
            $article = new Article();
        }
        //Formulaire        
        $form = $this->createForm(ArticleType::class, $article);
        if($this->formIsValid($form))
        {
            $this->manager->persist($article);
            $this->manager->flush();
            $this->addFlash('success', 'admin.article.form.flash.success');
            $this->setRedirect('admin_article_gerer');
            $this->addParamRedirect('idarticle', $article->getId());
        }
        //Affichage        
        $this->setTwig('pages/admin_article/page____admin_article____article____form.html.twig');
        $this->addParamTwig('form', $form->createView());        
    }
}
