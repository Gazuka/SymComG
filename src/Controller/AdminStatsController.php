<?php

namespace App\Controller;

use App\Entity\Stats\Log;
use App\Entity\Stats\StatsLog;
use App\Entity\Article\Article;
use App\Entity\Agenda\Evenement;
use App\Entity\Stats\StatsParam;
use App\Entity\Stats\StatsRoute;
use App\Entity\Organisme\Service;
use App\Controller\AdminController;
use App\Entity\Architecture\Chemin;
use App\Entity\Organisme\Organisme;
use App\Entity\Organisme\Association;
use App\Entity\Architecture\RouteParam;
use App\Entity\Architecture\Route as Route2;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminStatsController extends AdminController
{
    /**
     * @Route("/admin/stats", name="admin_stats")
     */
    public function index(): Response
    {
        $nbrLogsAAnalyser = $this->manager->getRepository(Log::class)->compter();
        $this->addParamTwig('nbrLogsAAnalyser', $nbrLogsAAnalyser);
        $chemins = $this->manager->getRepository(Chemin::class)->findAll();
        $this->addParamTwig('chemins', $chemins);
        //Affichage
        $this->setTwig('pages/admin_stats/page____admin_stats____accueil.html.twig');
        return $this->afficher('admin.stats.accueil.titre');
    }

    /**
     * @Route("/admin/stats/nommer", name="admin_stats_nommer")
     */
    public function nommer(): Response
    {
        $chemins = $this->manager->getRepository(Chemin::class)->findAll();
        foreach($chemins as $chemin)
        {
            if($chemin->getNom() == null)
            {
                //On tente de nommer le chemin
                switch($chemin->getRoute()->getNom())
                {
                    case 'site_accueil':
                        $nom = 'accueil';
                    break;
                    case 'site_article':
                        $idarticle = $chemin->recupParam('idarticle');
                        $article = $this->findById(Article::class, $idarticle);
                        $nom = 'article : '.$article;
                    break;
                    case 'site_articles':
                        $nom = 'actualités';
                    break;
                    case 'site_articles_associations':
                        $nom = 'actualités des associations';
                    break;
                    case 'site_arretes_municipaux':
                        $nom = 'arrêté municipaux';
                    break;
                    case 'site_articles_organisme':
                        $idorganisme = $chemin->recupParam('idorganisme');
                        $organisme = $this->findById(Organisme::class, $idorganisme);
                        $nom = 'actualités de '.$organisme;
                    break;
                    case 'site_association':
                        $slugassociation = $chemin->recupParam('slugassociation');
                        $association = $this->findBySlug(Association::class, $slugassociation);
                        $nom = 'association : '.$association;
                    break;
                    case 'site_associations':
                        $nom = 'associations';
                    break;
                    case 'site_associations_types':
                        $nom = 'Recherche des associations de type : '.$chemin->recupParam('typeRecherche ');
                    break;
                    case 'site_evenement':
                        $idevenement = $chemin->recupParam('idevenement');
                        $evenement = $this->findById(Evenement::class, $idevenement);
                        $nom = 'événement : '.$evenement;
                    break;
                    case 'site_evenements':
                        $nom = 'événements';
                    break;
                    case 'site_service':
                        $slugservice = $chemin->recupParam('slugservice');
                        $service = $this->findBySlug(Service::class, $slugservice);
                        $nom = 'service : '.$service;
                    break;
                    case 'site_services':
                        $nom = 'services';
                    break;
                    default:
                        $nom = null;
                    break;
                }
                $chemin->setNom($nom);
                $this->manager->persist($chemin);
            }
        }
        //Affichage
        $this->manager->flush();
        $this->setRedirect('admin_stats');
        return $this->afficher();
    }    

    /**
     * @Route("/admin/stats/analyser", name="admin_stats_analyser")
     */
    public function analyser(): Response
    {
        // Récupération des logs rapides
        $logs = $this->manager->getRepository(Log::class)->findSerie(50);
        foreach($logs as $log)
        {
            $nomRoute = $log->getChemin()->getRoute();
            //Si on demarre par admin_ le log n'est pas enregistré
            if(strpos($nomRoute, "admin_" ) === 0 )
            {
                $this->supprimer(Log::class, $log->getId());            
                $this->manager->flush();
            }
            else
            {
                $statsLog = new StatsLog();
                $chemin = new Chemin();
                
                //On récupére la route si elle existe ou on là crée
                $route = $this->manager->getRepository(Route2::class)->findOneBy(['nom' => $nomRoute]);
                if($route == null)
                {
                    $route = new Route2();
                    $route->setNom($nomRoute);
                }
                $chemin->setRoute($route);
    
                //On récupére les params si ils existent ou on les crées
                $paramsRoute = $log->getChemin()->getParams();
                foreach($paramsRoute as $param => $valeur)
                {
                    if($valeur != null)
                    {
                        $paramRoute = $this->manager->getRepository(RouteParam::class)->findOneBy(['param' => $param, 'valeur' => $valeur]);
                        if($paramRoute == null)
                        {
                            $paramRoute = new RouteParam();
                            $paramRoute->setParam($param);
                            $paramRoute->setValeur($valeur);
                            //On sauvegarde immédiatement si c'est une nouvelle combinaison pour éviter les doublons
                            // $this->manager->persist($paramRoute);
                            // $this->manager->flush();
                        }
                        $chemin->addRouteParam($paramRoute);
                    }
                }
    
                //On vérifie si le chemin existe
                //On récupère tous les chemins avec la même route
                $cheminsATester = $this->manager->getRepository(Chemin::class)->findBy(['route' => $chemin->getRoute()]);
                foreach($cheminsATester as $cheminATester)
                {
                    //On va tester ici si les parametres sont identiques
                    if($cheminATester->returnIdParams() == $chemin->returnIdParams())
                    {
                        $chemin = $cheminATester;
                        break; //On quitte le foreach
                    }
                    
                }
                // $this->manager->persist($chemin);
                $statsLog->setChemin($chemin);
                
                
                //On récupére la date
                $statsLog->setDateTime($log->getDateTime());
                $this->manager->persist($statsLog);
                $this->supprimer(Log::class, $log->getId());            
    
                //On flush dans la boucle pour eviter les doublons
                $this->manager->flush();
            }
        }
        
        //Affichage
        $this->setRedirect('admin_stats');
        return $this->afficher();
    }
}
