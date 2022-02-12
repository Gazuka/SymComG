<?php

namespace App\Controller;

use App\Form\PhotoType;
use App\Form\AfficheType;
use App\Entity\Classeur\Media;
use App\Entity\Classeur\Classeur;
use App\Entity\Classeur\Document;
use App\Controller\AdminController;
use App\Entity\Classeur\Support\Pdf;
use App\Entity\Classeur\Support\Image;
use App\Entity\Classeur\Format\Image\Icone;
use App\Entity\Classeur\Format\Image\Photo;
use App\Entity\Classeur\Format\Image\Affiche;
use App\Form\Classeur\Format\Image\IconeType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Classeur\Format\Pdf\Deliberation;
use App\Entity\Classeur\Format\Pdf\MarchePublic;
use App\Form\Classeur\Format\Pdf\DeliberationType;
use App\Form\Classeur\Format\Pdf\MarchePublicType;
use App\Entity\Classeur\Format\Pdf\ArreteMunicipal;
use App\Entity\Classeur\Format\Pdf\BulletinMunicipal;
use App\Form\Classeur\Format\Pdf\ArreteMunicipalType;
use Symfony\Component\Translation\TranslatableMessage;
use App\Form\Classeur\Format\Pdf\BulletinMunicipalType;
use App\Entity\Classeur\Dossier;use App\Entity\Classeur\Fichier;

class AdminClasseurController extends AdminController
{
    const DOSSIER_DEPOT = 'depot';
    const DOSSIER_TRIAGE = 'triage';
    const CHOIX_SUPPORTS_MEDIAS = [
                                'image' => [
                                                'supportLabel' => 'admin.medias.choisir.image',
                                                'formats' => [
                                                                'affiche' => [
                                                                                'format' => 'affiche',
                                                                                'formatLabel' => 'admin.medias.choisir.affiche',
                                                                                'class' => Affiche::class,
                                                                                'typeClass' => AfficheType::class                                                                                
                                                                            ],
                                                                'photo' => [
                                                                                'format' => 'photo',
                                                                                'formatLabel' => 'admin.medias.choisir.photo',
                                                                                'class' => Photo::class,
                                                                                'typeClass' => PhotoType::class
                                                                            ],
                                                                'icone' => [
                                                                                'format' => 'icone',
                                                                                'formatLabel' => 'admin.medias.choisir.icone',
                                                                                'class' => Icone::class,
                                                                                'typeClass' => IconeType::class
                                                                            ]
                                                            ]
                                            ],
                                'pdf' => [
                                                'supportLabel' => 'admin.medias.choisir.pdf',
                                                'formats' => [
                                                                'bulletin' => [
                                                                                'format' => 'bulletin',
                                                                                'formatLabel' => 'admin.medias.choisir.bulletin',
                                                                                'class' => BulletinMunicipal::class,
                                                                                'typeClass' => BulletinMunicipalType::class
                                                                            ],
                                                                'deliberation' => [
                                                                                'format' => 'deliberation',
                                                                                'formatLabel' => 'admin.medias.choisir.deliberation',
                                                                                'class' => Deliberation::class,
                                                                                'typeClass' => DeliberationType::class
                                                                            ],
                                                                'arrete' => [
                                                                                'format' => 'arrete',
                                                                                'formatLabel' => 'admin.medias.choisir.arrete',
                                                                                'class' => ArreteMunicipal::class,
                                                                                'typeClass' => ArreteMunicipalType::class
                                                                            ],
                                                                'marchepublic' => [
                                                                    'format' => 'marchepublic',
                                                                    'formatLabel' => 'admin.medias.choisir.marchepublic',
                                                                    'class' => MarchePublic::class,
                                                                    'typeClass' => MarchePublicType::class
                                                                ]
                                                            ]
                                        ],
                            ];
    private $medias;
    private $fichiersOrphelins;

    /**
     * PUBLIC : Gestion des médias
     * 
     * @Route("/admin/medias", name="admin_medias")
     * @return Response
     */
    public function gererMedias(): Response
    {
        $this->initialiserGestionnaire();
        //Affichage
        // $this->setTwig('admin/classeur/medias_gerer.html.twig');
        $this->setTwig('pages/admin_classeur/page____admin_classeur____media____ajouter.html.twig');
        $this->addParamTwig('sousTitre', 'admin.medias.gerer.titre');        
        return $this->afficher('admin.medias.interface.titre');
    }

    /**
     * PUBLIC : Gestion des fichiers orphelins
     * 
     * @Route("/admin/medias/fichiers/orphelins", name="admin_medias_fichiers_orphelins")
     * @return Response
     */
    public function gererFichiersOrphelins(): Response
    {
        $this->initialiserGestionnaire();
        //Détermine si les fichiers orphelins sont des pdf, images...
        $this->definirSupportOrphelins();
        //On récupére les médias qui ne servent pas (pas encore un document)
        $this->mediasOrphelins = $this->repoService->findBy(Media::class, ['document' => null]);
        $this->addParamTwig('mediasOrphelins', $this->mediasOrphelins);
        //Affichage
        $this->setTwig('pages/admin_classeur/page____admin_classeur____medias____voir_orphelins.html.twig');
        $this->addParamTwig('sousTitre', 'admin.medias.fichiers.orphelins.gerer.titre');
        return $this->afficher('admin.medias.orphelins.gerer.titre');
    }

    /**
     * PUBLIC : Gestion des médias orphelins
     * 
     * @Route("/admin/medias/orphelins", name="admin_medias_orphelins")
     * @return Response
     */
    public function gererMediasOrphelins(): Response
    {
        $this->initialiserGestionnaire();
        //Affichage
        $this->setTwig('pages/admin_classeur/page____admin_classeur____medias____voir_orphelins.html.twig');
        $this->addParamTwig('sousTitre', 'admin.medias.gerer.titre');        
        return $this->afficher('admin.medias.orphelins.gerer.titre');
    }

    /**
     * PUBLIC : Afficher les fichiers contenu dans un dossier
     * 
     * @Route("/admin/medias/dossier/{iddossier}", name="admin_medias_dossier", requirements={"iddossier"="\-?[0-9]+"})
     * @return Response
     */
    public function afficherContenuDossier($iddossier): Response
    {
        $this->initialiserGestionnaire();
        $dossier = $this->repoService->findById(Dossier::class, $iddossier);
        //Affichage
        $this->setTwig('entity/classeur/dossier/_voir____dossier____explorer.html.twig');
        $this->addParamTwig('sousTitre', 'admin.medias.afficher.dossier.titre');
        $this->addParamTwig('dossierActuel', $dossier);
        return $this->afficher('admin.medias.orphelins.gerer.titre');
    }

    /**
     * PUBLIC : Afficher un média non documenté
     * 
     * @Route("/admin/medias/media/{idmedia}", name="admin_medias_media", requirements={"idmedia"="\-?[0-9]+"})
     * @return Response
     */
    public function afficherMedia($idmedia): Response
    {
        $this->initialiserGestionnaire();
        $media = $this->repoService->findById(Media::class, $idmedia);
        //Définir les choix de sous type de media possibles
        $this->addParamTwig('choix', self::CHOIX_SUPPORTS_MEDIAS[$media->getSupportName()]);
        //Affichage
        $this->setTwig('pages/admin_classeur/page____admin_classeur____media____voir.html.twig');
        $this->addParamTwig('media', $media);        
        $this->addParamTwig('sousTitre', 'admin.medias.media.voir.titre');
        return $this->afficher('admin.medias.orphelins.gerer.titre');
    }

    /**
     * PUBLIC : Ajouter un document dans un classeur puis rediriger vers le parent actif
     * 
     * @Route("/admin/classeur/joindre/document/{iddocument}/{idclasseur}/{nomAvis}", name="admin_classeur_joindre_document", requirements={"iddocument"="\-?[0-9]+", "idclasseur"="\-?[0-9]+"})
     * @return Response
     */
    public function ajouterDocumentAClasseur($iddocument, $idclasseur, $nomAvis): Response
    {
        $document = $this->repoService->findById(Document::class, $iddocument);
        $classeur = $this->repoService->findById(Classeur::class, $idclasseur);
        $classeur->addDocument($document);
        $this->manager->persist($classeur);
        $this->manager->flush();
        $this->addFlash('success', 'admin.media.ajout.document.classeur.flash.success');
        //On redirige vers le chemin spécifié précédemment
        $this->redirectViaChemin($this->classeurService->recupChemin($nomAvis));
        //On supprime les variables de la session
        $this->classeurService->supprimerAvisRechercheDocument($nomAvis);        
        return $this->afficher();
    }

    /**
     * PUBLIC : Afficher un document
     * 
     * @Route("/admin/medias/document/{iddocument}", name="admin_medias_document", requirements={"iddocument"="\-?[0-9]+"})
     * @return Response
     */
    public function afficherDocument($iddocument): Response
    {
        $this->initialiserGestionnaire();
        $document = $this->repoService->findById(Document::class, $iddocument);        
        //Affichage
        $this->setTwig('pages/admin_classeur/page____admin_classeur____document____voir.html.twig');
        $this->addParamTwig('document', $document);        
        $this->addParamTwig('sousTitre', 'admin.medias.media.voir.titre');
        return $this->afficher('admin.medias.orphelins.gerer.titre');
    }

    /**
     * PUBLIC : Définit un format pour le Média
     * 
     * @Route("/admin/medias/media/format/definir/{idmedia}/{formatname}", name="admin_medias_media_format_definir", requirements={"idmedia"="\-?[0-9]+"})
     * @return Response
     */
    public function definirFormatMedia($idmedia, $formatname): Response
    {
        $this->initialiserGestionnaire();
        $media = $this->repoService->findById(Media::class, $idmedia);
        //Récupérer les infos du type
        $configFormat = self::CHOIX_SUPPORTS_MEDIAS[$media->getSupportName()]['formats'][$formatname];
        //Ex : création du format (une affiche)
        $format = new $configFormat['class']();
        //Ex : on récupère l'objet Support (Image)
        $support = $media->getSupport();
        $format->setSupport($support);
        //On propose un formulaire en fonction du format
        $this->genererFormulaire($configFormat, $format);
        //Affichage        
        $this->addParamTwig('media', $media);        
        $this->addParamTwig('sousTitre', 'admin.medias.media.voir.titre');
        return $this->afficher('admin.medias.orphelins.gerer.titre');
    }

    /**
     * PUBLIC : Edition du Média
     * 
     * @Route("/admin/medias/media/edit/{idmedia}", name="admin_medias_media_edit", requirements={"idmedia"="\-?[0-9]+"})
     * @return Response
     */
    public function editerMedia($idmedia): Response
    {
        $this->initialiserGestionnaire();
        $media = $this->repoService->findById(Media::class, $idmedia);
        //Récupérer les infos du type
        $support = $media->getSupport();
        $format = $support->getFormat();        
        $configFormat = self::CHOIX_SUPPORTS_MEDIAS[$media->getSupportName()]['formats'][$support->getFormatName()];
        //On propose un formulaire en fonction du format
        $this->genererFormulaire($configFormat, $format);
        //Affichage        
        $this->addParamTwig('media', $media);        
        $this->addParamTwig('sousTitre', 'admin.medias.media.voir.titre');
        return $this->afficher('admin.medias.orphelins.gerer.titre');
    }

    private function genererFormulaire($configFormat, $format): void
    {
        //Formulaire        
        $form = $this->createForm($configFormat['typeClass'], $format);
        if($this->formIsValid($form))
        {
            //2 - On deplace le fichier            
            $fichier = $format->getSupport()->getMedia()->getFichier();
            $dossier = $this->recupererDossier($configFormat['format'], "...");
            $fichier->deplacer($dossier); /////////DEBUG : A FAIRE : Si true ok si false message d'erreur
            //3 - On crée le document
            if($fichier->getMedia()->getDocument() == null)
            {
                $document = new Document();
                $document->setMedia($format->getSupport()->getMedia());
            }     
            else
            {
                $document = $fichier->getMedia()->getDocument();
            }       
            //4 - On enregistre l'ensemble
            $this->manager->persist($format);
            $this->manager->flush();
            $this->addFlash('success', 'admin.media.add.format.form.flash.success.'.$configFormat['format']);
            //5 - On redirige vers la page du document
            $this->setRedirect('admin_medias_document');
            $this->addParamRedirect('iddocument', $document->getId());
        }
        //Affichage        
        $this->setTwig('pages/admin_classeur/page____admin_classeur____media____formulaire.html.twig');
        $this->addParamTwig('form', $form->createView());
        $this->addParamTwig('formatName', $configFormat['format']);
    }

    /**
     * Permet de récupérer les valeurs nécessaires au fonctionnement de l'interface du gestionnaire
     */
    private function initialiserGestionnaire(): void
    {
        //Récupère les dossiers racines pour la création de l'arborescence
        $dossiersRacines = $this->repoService->findAll(Dossier::class, ['parent' => null]);
        $this->addParamTwig('dossiers', $dossiersRacines);
        //Scanner le dossier de dépot et informe du nombre de détections
        $nbrNouveauxFichiers = $this->scanDepot();
        if($nbrNouveauxFichiers > 0)
        {
            $this->addFlash('info', 'admin.medias.scan.depot.info', ['nbrNouveauxFichiers' => $nbrNouveauxFichiers]);
        }
        //Récupère les fichiers orphelins (qui ne sont pas rattaché à un média)
        $this->fichiersOrphelins = $this->repoService->findBy(Fichier::class, ['media' => null]);
        $this->addParamTwig('fichiersOrphelins', $this->fichiersOrphelins);
        //On récupére les médias qui ne servent pas (pas encore un document)
        $this->mediasOrphelins = $this->repoService->findBy(Media::class, ['document' => null]);
        $this->addParamTwig('mediasOrphelins', $this->mediasOrphelins);
        //Récupére les médias
        $documents = $this->repoService->findAll(Document::class);
        $this->addParamTwig('documents', $documents);
        $this->addParamTwig('classeurService', $this->classeurService);
    }

    /**
     * Analyse le dossier "dépot" afin de vérifier l'arrivage de nouveaux fichiers
     * @return Int //Nombre de fichiers trouvés
     */
    private function scanDepot():int
    {
        $dossierDepot = $this->recupererDossier(self::DOSSIER_DEPOT, 'dossier.depot.descriptif');
        //On scanne le dossier de dépot
        $scan = $dossierDepot->scannerDossier();
        //On traite les résultats
        if(sizeof($scan) > 2)
        {
            foreach($scan as $resultat)
            {
                if($resultat != '.' && $resultat !='..')
                {         
                    //On crée l'objet fichier
                    $fichier = new Fichier();
                    $fichier->setDossier($dossierDepot);
                    $fichier->decortiqueNom($resultat);
                    //On déplace le fichier
                    $dossierTriage = $this->recupererDossier(self::DOSSIER_TRIAGE, 'dossier.triage.descriptif');
                    $fichier->deplacer($dossierTriage); /////////DEBUG : A FAIRE : Si true ok si false message d'erreur
                    //On enregistre le fichier
                    $this->manager->persist($fichier);
                }
                $this->manager->flush();
            }
        }
        return sizeof($scan)-2;
    }

    /**
     * Permet de récupérer un dossier à partir de son titre, s'il n'existe pas on le crée (avec un descriptif)
     */
    private function recupererDossier($titre, $descriptif)
    {
        $dossier = $this->repoService->findOneBy(Dossier::class, ['titre' => $titre]);
        if($dossier == null)
        {
            //Si pas de dossier on crée le dossier de dépot
            $dossier = $this->creerDossier($titre, $this->directTrad($descriptif));                       
        }
        return $dossier;
    }

    /**
     * Détermine si les orphelins sont des images, pdf ou autres...
     */
    public function definirSupportOrphelins()
    {
        foreach($this->fichiersOrphelins as $fichier)
        {
            switch(strtolower($fichier->getExtension()))
            {
                case 'pdf' :
                    $media = new Media();
                    $media->setfichier($fichier);
                    $pdf = new Pdf();
                    $media->setPdf($pdf);
                    $this->manager->persist($media);
                break;
                case 'jpg':
                case 'jpeg':
                    $media = new Media();
                    $media->setfichier($fichier);
                    $image = new Image();
                    $media->setImage($image);
                    $this->manager->persist($media);
                break;
                default:
                    dd("debug - inconnu");
                break;
            }            
        }
        $this->manager->flush();
    }

    /**
     * Permet de créer un nouveau dossier
     */
    private function creerDossier($titre, $descriptif, $parent = null)
    {
        $dossier = new Dossier();
        $dossier->setTitre($titre);
        $dossier->setDescriptif($descriptif);
        $dossier->setParent($parent);
        $dossier->creerDossierPhysique();
        $this->manager->persist($dossier);
        $this->manager->flush();
        $this->addFlash('success', 'admin.medias.dossier.creer.flash.success', ['titre' => $titre]);
        return $dossier;
    }  

    /**
     * PUBLIC : Ajouter un Média
     * 
     * @Route("/admin/classeur/ajouter/{typeParent}/{idparent}/{typeName}", name="admin_classeur_ajouter_media", requirements={"idparent"="\-?[0-9]+"})
     * @return Response
     */
    public function addMedia($typeParent, $idparent, $typeName)
    {
        //Récupération du parent
        $parent = $this->entityService->setName($typeParent)->getEntity($idparent);
        
        //Récupérer ou créer le classeur selon le type et l'enregistrer
        $classeur = $this->classeurService->recupererLeBonClasseur($parent, $typeName);
        $this->manager->persist($classeur);
        $this->manager->flush();
        
        //Création d'un avisRechecheDocument
        $nomAvis = $typeParent;
        $this->classeurService->creerAvisRechercheDocument($nomAvis, $parent, $classeur, 'admin.classeur.joindre.media.bouton.label', $this->sessionService->recupChemin('cheminPrecedant'));
        if($typeParent == 'organisme')
        {
            $this->classeurService->recupMediasAutorises($nomAvis, $parent->getTypeStructure(), $typeName);
        }
        else
        {
            $this->classeurService->recupMediasAutorises($nomAvis, $parent->getNomClasse(), $typeName);
        }
        $this->classeurService->enregistrerAvis($nomAvis);
        
        //Redirection vers la gestion des médias
        $this->setRedirect('admin_medias');
        //Affichage        
        return $this->afficher();
    }

    /**
     * PUBLIC : Test
     * 
     * @Route("/admin/classeur/pdf/creer/vignette/{idmedia}", name="admin_classeur_pdf_creer_vignette", requirements={"idmedia"="\-?[0-9]+"})
     * @return Response
     */
    public function creerVignettePdf($idmedia)
    {
        $media = $this->findById(Media::class, $idmedia);

        if($media->getPdf() != null)
        {
            $this->addFlash('success', "C'est un pdf");
            //dump("C'est un pdf");
            //On récupère le chemin du pdf
            $cheminPdf = $media->getFichier()->getChemin();
            //On choisi un chemin pour la vignette
            $cheminVignette = substr_replace($cheminPdf, "jpg", -3, 3);
            $commande = str_replace("/", "\\", "convert ".$cheminPdf."[0] ".$cheminVignette);
            system($commande);
            //dump($commande);
        }
        else
        {
            //dump("Ce n'est pas un pdf");
            $this->addFlash('danger', "Ce n'est pas un pdf");
        }
        
        //Affichage        
        $this->setRedirect('admin_medias');
        return $this->afficher();
    }
}