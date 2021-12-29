<?php

namespace App\Controller;

use DateTime;
use App\Entity\Agenda\Evenement;
use App\Entity\Article\Article;
use App\Entity\Profil\Profil;
use App\Entity\Classeur\Classeur;
use App\Entity\Courrier\Courrier;
use App\Form\Courrier\CourrierType;
use App\Entity\Organisme\Service;
use App\Entity\Organisme\Organisme;
use App\Entity\Organisme\Association;
use App\Entity\Organisme\Entreprise;
use App\Entity\CarteVisite\CarteVisite;
use App\Entity\Classeur\Format\Image\Photo;
use App\Entity\Classeur\Format\Image\Affiche;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Classeur\Format\Pdf\Deliberation;
use Symfony\Component\Validator\Constraints\Date;
use App\Entity\Classeur\Format\Pdf\ArreteMunicipal;
use App\Entity\Classeur\Format\Pdf\BulletinMunicipal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SiteController extends SymComGController
{
    //============================
    // --- AFFICHAGE DES PAGES ---
    //============================

    /**
     * @Route("/site", name="site_accueil")
     */
    public function index(): Response
    {
        // --- Appel de la page d'accueil ---
        $this->setTwig('pages/site/page____site____accueil.html.twig');

        // --- Affichage des actualités ---
        $limitArticles = $this->getParameter('page_accueil.nbr_article');
        $articles = $this->manager->getRepository(Article::class)->findActualites($limitArticles);
        $this->addParamTwig('articles', $articles);

        // --- Affichage de l'agenda ---
        $this->recupererEvenements($this->getParameter('page_accueil.nbr_evenement'));
        
        // --- Affichage du panneau d'affichage (classeur avec toutes les affiches)
        $classeurAffiches = $this->recupererClasseurAffiches();  
        $this->addParamTwig('classeurAffiches', $classeurAffiches);

        // --- Affichage de l'actu en images (classeur avec des photos)
        $classeurActus = $this->recupererClasseurActus();  
        $this->addParamTwig('classeurActus', $classeurActus);

        // --- Affichage des derniers arrêtés municipaux ---
        $limitArretes = $this->getParameter('page_accueil.nbr_arretes');
        $classeurArretes = $this->recupererClasseurArretes($limitArretes);  
        $this->addParamTwig('classeurArretes', $classeurArretes);

        return $this->afficher();
    }

    /**
     * @Route("/arretes", name="site_arretes_municipaux")
     */
    public function voirArretesMunicipaux(): Response
    {
        $this->setTwig('pages/site/page____site____arretes_municipaux.html.twig');
        // --- Récupération des arrêtés municipaux ---
        $classeurArretes = $this->recupererClasseurArretes();        
        $this->addParamTwig('classeur', $classeurArretes);
        return $this->afficher();
    }

    /**
     * @Route("/annuaire/{typestructure}/{idenumtype}", name="site_annuaire", requirements={"idenumtype"="\-?[0-9]+"})
     */
    public function voirAnnuaire($typestructure = null, $idenumtype = null): Response
    {
        //DEBUG : gerer le idenumtype pour affichage de certains types uniquement
        switch($typestructure)
        {
            case 'association':
                // --- Récupération des associations pour afficher les cartes de visites ---
                $associations = $this->repoService->findBy(Association::class, [], ['nom' => 'asc']); 
                $this->addParamTwig('associations', $associations);                
            break;
            case 'service':
                // --- Récupération des services pour afficher les cartes de visites ---
                $services = $this->repoService->findBy(Service::class, [], ['nom' => 'asc']); 
                $this->addParamTwig('services', $services);             
            break;
            case 'entreprise':
                // --- Récupération des entreprises pour afficher les cartes de visites ---
                $entreprises = $this->repoService->findBy(Entreprise::class, [], ['nom' => 'asc']); 
                $this->addParamTwig('entreprises', $entreprises);
            break;
            default:
                // --- Récupération des associations pour afficher les cartes de visites ---
                $associations = $this->repoService->findBy(Association::class, [], ['nom' => 'asc']); 
                // --- Récupération des services pour afficher les cartes de visites ---
                $services = $this->repoService->findBy(Service::class, [], ['nom' => 'asc']); 
                // --- Récupération des entreprises pour afficher les cartes de visites ---
                $entreprises = $this->repoService->findBy(Entreprise::class, [], ['nom' => 'asc']); 
                $this->addParamTwig('associations', $associations);
                $this->addParamTwig('services', $services);
                $this->addParamTwig('entreprises', $entreprises);
            break;
        }
        $this->setTwig('pages/site/page____site____annuaire.html.twig');
        
        return $this->afficher();
    }

    /**
     * @Route("/deliberations", name="site_deliberations")
     */
    public function voirDeliberations(): Response
    {
        $this->setTwig('pages/site/page____site____deliberations.html.twig');
        // --- Récupération des délibérations ---
        $classeurDeliberations = $this->recupererClasseurDeliberations();        
        $this->addParamTwig('classeur', $classeurDeliberations);
        return $this->afficher();
    }

    /**
     * @Route("/article/{idarticle}", name="site_article", requirements={"idarticle"="\-?[0-9]+"})
     */
    public function voirArticle($idarticle): Response
    {
        $article = $this->findById(Article::class, $idarticle);
        $this->setTwig('pages/site/page____site____article.html.twig');
        $this->addParamTwig('article', $article);
        return $this->afficher();
    }

    /**
     * @Route("/evenement/{idevenement}", name="site_evenement", requirements={"idevenement"="\-?[0-9]+"})
     */
    public function voirEvenement($idevenement): Response
    {
        $evenement = $this->findById(Evenement::class, $idevenement);
        $this->setTwig('pages/site/page____site____evenement.html.twig');
        $this->addParamTwig('evenement', $evenement);
        return $this->afficher();
    }

    /**
     * @Route("/articles", name="site_articles")
     */
    public function voirArticles(): Response
    {
        $limit = $this->getParameter('page_articles.nbr_article');
        $articles = $this->manager->getRepository(Article::class)->findActualites($limit);
        
        $this->setTwig('pages/site/page____site____articles.html.twig');
        $this->addParamTwig('articles', $articles);
        return $this->afficher();
    }

    /**
     * @Route("/evenements", name="site_evenements")
     */
     public function voirAgenda(): Response
     {
        // --- Appel de la page d'agenda ---
        $this->setTwig('pages/site/page____site____evenements.html.twig');

        // --- Affichage de l'agenda ---
        $this->recupererEvenements(100);        
        return $this->afficher();
     }

    /**
     * @Route("/articles/associations", name="site_articles_associations")
     */
    public function voirArticlesAssociations(): Response
    {
        $articles = $this->findAll(Article::class);
        $articlesAssos = array();
        foreach($articles as $article)
        {
            if($article->testSiAssociationLiee() == true)
            {
                array_push($articlesAssos, $article);
            }            
        }
        $this->setTwig('pages/site/page____site____articles.html.twig');
        $this->addParamTwig('articles', $articlesAssos);
        $this->addParamTwig('titreAlternatif', 'Actualités des associations');
        return $this->afficher();
    }

    /**
     * @Route("/articles/organisme/{idorganisme}", name="site_articles_organisme", requirements={"idorganisme"="\-?[0-9]+"})
     */
    public function voirArticlesOrganisme($idorganisme): Response
    {
        // $limit = $this->getParameter('page_articles.nbr_article');
        $articles = array();
        $organisme = $this->findById(Organisme::class, $idorganisme);
        foreach($organisme->getElemOrganismes() as $elemOrganisme)
        {
            array_push($articles, $elemOrganisme->getElemX()->getVisuel()->getArticleAnnexe());
        }
        
        $this->setTwig('pages/site/page____site____articles.html.twig');
        $this->addParamTwig('articles', $articles);

        switch($organisme->getStructure()->getSlug())
        {
            case 'conseil-municipal':
                $this->addParamTwig('titreAlternatif', 'La vie du Conseil Municipal');
            break;
            default :
                $this->addParamTwig('titreAlternatif', 'Actualités de '.$organisme->getStructure()->getNom());
            break;
        }
        
        return $this->afficher();
    }

    /**
     * @Route("/association/{slugassociation}", name="site_association")
     */
    public function voirAssociation($slugassociation): Response
    {
        $association = $this->findBySlug(Association::class, $slugassociation);
        $this->setTwig('pages/site/page____site____association.html.twig');
        $this->addParamTwig('association', $association);
        return $this->afficher();
    }

    /**
     * @Route("/service/{slugservice}", name="site_service")
     */
    public function voirService($slugservice): Response
    {
        $service = $this->findBySlug(Service::class, $slugservice);
        $this->setTwig('pages/site/page____site____service.html.twig');
        $this->addParamTwig('service', $service);
        $nbr_articles = $this->getParameter('page_service.nbr_articles');
        $this->addParamTwig('nbr_article', $nbr_articles);
        return $this->afficher();
    }

    /**
     * @Route("/conseilmunicipal/", name="site_conseil_municipal")
     */
    public function voirConseilMunicipal(): Response
    {
        $slugconseilmunicipal = 'conseil-municipal'; //DEBUG mettre la valeur dans un fichier de config ????
        $conseilmunicipal = $this->findBySlug(Service::class, $slugconseilmunicipal);
        $this->setTwig('pages/site/page____site____conseil_municipal.html.twig');
        $this->addParamTwig('service', $conseilmunicipal);
        return $this->afficher();
    }

    /**
     * @Route("/associations", name="site_associations")
     */
    public function voirAssociations(): Response
    {
        $this->setTwig('pages/site/page____site____associations.html.twig');
        $associations = $this->repoService->findBy(Association::class, ['local' => true], ['nom' => 'asc']);        
        $this->addParamTwig('associations', $associations);
        return $this->afficher();
    }

    /**
     * @Route("/associations/{typeRecherche}", name="site_associations_types")
     */
    public function voirAssociationsType($typeRecherche): Response
    {
        $typesRecherches = explode('-', $typeRecherche);
        $this->setTwig('pages/site/page____site____associations.html.twig');
        $associations = $this->repoService->findBy(Association::class, [], ['nom' => 'asc']);
        $associationsType = array();
        foreach($associations as $association)
        {            
            foreach($association->getTypes() as $type)
            {                
                if(in_array(strtolower($type->getNom()), $typesRecherches))
                {
                    array_push($associationsType, $association);                    
                }
            }
        }
        $this->addParamTwig('associations', $associationsType);
        // Bidouille pour le texte alternatif...
        $titreAlternatif = 'Associations';
        $size = sizeOf($typesRecherches);
        $i=1;
        foreach($typesRecherches as $tr)
        {
            switch($i)
            {
                case 1:
                    $titreAlternatif .= ' '.$tr.'s';
                break;
                case $size:
                    $titreAlternatif .= ' et '.$tr.'s';
                break;
                default:
                    $titreAlternatif .= ', '.$tr.'s';
                break;
            }            
            $i = $i+1;
        }
         str_replace('-', 's, ', $typeRecherche).'s';
        $this->addParamTwig('titreAlternatif', $titreAlternatif);
        return $this->afficher();
    }

    /**
     * @Route("/services", name="site_services")
     */
    public function voirServices(): Response
    {
        $this->setTwig('pages/site/page____site____services.html.twig');
        $services = $this->repoService->findBy(Service::class, [], ['nom' => 'asc']);        
        $this->addParamTwig('services', $services);
        $this->addParamTwig('affichageLocalUniquement', true);
        return $this->afficher();
    }

    /**
     * @Route("/services/scolaire", name="site_services_scolaire")
     */
    public function voirServicesScolaire(): Response
    {
        $this->setTwig('pages/site/page____site____services.html.twig');
        $services = $this->repoService->findBy(Service::class, ['id' => array(17, 18, 19, 20)], ['nom' => 'asc']);
        dump($services);
        $this->addParamTwig('services', $services);
        $this->addParamTwig('affichageLocalUniquement', false);
        return $this->afficher();
    }

    /**
     * @Route("/bulletins", name="site_bulletins_municipaux")
     */
    public function voirBulletinsMunicipaux(): Response
    {
        $bulletins = $this->repoService->findBy(BulletinMunicipal::class, [], ['date' => 'desc']);
        // $bulletins = $this->FindAll(BulletinMunicipal::class);
        $this->setTwig('pages/site/page____site____bulletins_municipaux.html.twig');
        $this->addParamTwig('bulletins', $bulletins);
        return $this->afficher();
    }

    /**
     * @Route("/courrier/{idprofil}", name="site_courrier", requirements={"idprofil"="\-?[0-9]+"})
     */
    public function ecrireCourrier($idprofil): Response
    {
        $this->setTwig('pages/site/page____site____courrier.html.twig');
        // --- Récupération du destinataire ---
        $profil = $this->findById(Profil::class, $idprofil);
        
        //Formulaire
        $courrier = new Courrier();
        $form = $this->createForm(CourrierType::class, $courrier);
        if($this->formIsValid($form))
        {
            // $this->manager->persist($article);
            // $this->manager->flush();
            // $this->addFlash('success', 'admin.article.form.flash.success');
            // $this->setRedirect('admin_article_gerer');
            // $this->addParamRedirect('idarticle', $article->getId());
        }
        $this->addParamTwig('form', $form->createView()); 
        
        //Affichage
        $this->addParamTwig('profil', $profil);
        return $this->afficher();
    }

    //==================
    // --- FONCTIONS ---
    //==================
    private function recupererClasseurAffiches()
    {
        // On récupère toutes les affiches (DEBUG : ne prendre que celles qui sont d'actualité par la suite)
        $affiches = $this->manager->getRepository(Affiche::class)->findActuelles();        
        // On crée le classeur et on lui donne toutes les affiches
        $classeurAffiches = new Classeur();
        foreach($affiches as $affiche)
        {
            $classeurAffiches->addDocument($affiche->getSupport()->getMedia()->getDocument());
        }
        return $classeurAffiches;
    }

    private function recupererClasseurActus()
    {
        // On récupère toutes les photos marquées comme actualité
        $photosActus = $this->manager->getRepository(Photo::class)->findActualites();        
        // On crée le classeur et on lui donne toutes les affiches
        $classeurActus = new Classeur();
        foreach($photosActus as $photoActu)
        {
            $classeurActus->addDocument($photoActu->getSupport()->getMedia()->getDocument());
        }
        return $classeurActus;
    }

    private function recupererClasseurArretes($limit = null, $offset = 1)
    {
        if($limit == null)
        {
            $limit = $this->getParameter('page_arretes.nbr_arretes');
        }
        // On récupère les arrêtés municipaux
        $arretes = $this->manager->getRepository(ArreteMunicipal::class)->findArretes($limit, $offset);
        // On crée le classeur et on lui donne tous les arrêtés
        $classeurArretes = new Classeur();
        foreach($arretes as $arrete)
        {
            $classeurArretes->addDocument($arrete->getSupport()->getMedia()->getDocument());
        }
        return $classeurArretes;
    }

    private function recupererClasseurDeliberations()
    {
        // On récupère toutes les délibérations
        $deliberations = $this->findAll(Deliberation::class);
        // On crée le classeur et on lui donne toutes les délibérations
        $classeurDeliberations = new Classeur();
        foreach($deliberations as $deliberation)
        {
            $classeurDeliberations->addDocument($deliberation->getSupport()->getMedia()->getDocument());
        }
        return $classeurDeliberations;
    }

    private function recupererEvenements($nbrEvenements)
    {
        $evenements = $this->manager->getRepository(Evenement::class)->findProchains($nbrEvenements);
        $evenementsPrincipaux = $this->manager->getRepository(Evenement::class)->findPrincipaux();
        $this->addParamTwig('evenements', $evenements);
        $this->addParamTwig('evenementsPrincipaux', $evenementsPrincipaux);
    }
}
