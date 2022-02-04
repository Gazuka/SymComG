<?php

namespace App\Controller;

use App\Entity\Poste\Statut;
use App\Entity\Poste\Secteur;
use App\Entity\Poste\Fonction;
use App\Form\Poste\StatutType;
use App\Form\Poste\SecteurType;
use App\Form\Poste\FonctionType;
use App\Controller\AdminController;
use App\Form\EnumEntrepriseTypeType;
use App\Form\EnumAssociationTypeType;
use App\Entity\Organisme\EnumEntrepriseType;
use App\Entity\CarteVisite\EnumCategAnnuaire;
use App\Entity\Organisme\EnumAssociationType;
use Symfony\Component\HttpFoundation\Response;
use App\Form\CarteVisite\EnumCategAnnuaireType;
use Symfony\Component\Routing\Annotation\Route;

class AdminConfigController extends AdminController
{
    /**
     * PUBLIC : CHOISIR - Permet de choisir le enum
     * Appelé uniquement via une redirection
     * 
     * @Route("/admin/config/enum/choix/{demandeur}/{titre}", name="admin_config_enum_choisir")
     * @param string $demandeur //Nom d'une des routes (qui souhaite un choix de service)
     * @param string $titre //Titre de la page demandeuse en format trad.
     * @return Response
     */
    public function choisirEnum($demandeur, $titre): Response
    {        
        $choixPossible = ['entreprise', 'association', 'fonction', 'secteur', 'statut', 'categAnnuaire'];
        $this->setTwig('pages/admin_configuration/page____admin_configuration____enum_choisir.html.twig');
        $this->setTitre($titre);
        $this->addParamTwig('demandeur', $demandeur);
        $this->addParamTwig('choixPossible', $choixPossible);
        return $this->afficher();
    }
    
    /**
     * PUBLIC : VOIR - Afficher l'ensemble des types pour une classe
     * 
     * @Route("/admin/config/enums/{enumname?}", name="admin_config_enums_voir")
     * @param string $enumname
     * @return Response
     */
    public function voirEnums($enumname = null): Response
    {
        $parametres = $this->recupererClasseEnum($enumname, $demandeur = 'admin_config_enums_voir');
        if($parametres != null)
        {
            //Récupérer touts les enums du type demandé
            $enums = $this->findAll($parametres['enumClasse']);
            $this->setTitre('TRAD:mon titre');
            //Affichage
            $this->setTwig('pages/admin_configuration/page____admin_configuration____enums_voir.html.twig');
            $this->addParamTwig('enums', $enums);
            $this->addParamTwig('enumname', $enumname);
            $this->genererFormulaire($demandeur, $enumname);
        }
        //Affichage        
        return $this->afficher();
    }

    /**
     * PUBLIC : SUPPRIMER - Supprimer un enum
     * 
     * @Route("/admin/config/enum/supprimer/{enumname}/{idenum}", name="admin_config_enum_supprimer", requirements={"idenum"="\-?[0-9]+"})
     * @param integer $idenum
     * @return Response
     */
    public function supprimerEnum(string $enumname, int $idenum):Response
    {
        $parametres = $this->recupererClasseEnum($enumname);
        $enum = $this->findById($parametres['enumClasse'], $idenum);

        //Si l'objet a un enfant, on ne peut pas le supprimer !
        if(method_exists($enum,'getEnfants'))
        {
            if(sizeOf($enum->getEnfants()) == 0)
            {            
                //Supprimer de la BDD
                $this->supprimer($parametres['enumClasse'], $idenum);
                //Message
                // $this->addFlash('success', 'Ce service a bien été supprimé !');
            }
            else
            {
                //Message //Impossible de supprimer
            }
        }
        else
        {
            //Supprimer de la BDD
            $this->supprimer($parametres['enumClasse'], $idenum);
            //Message
            // $this->addFlash('success', 'Ce service a bien été supprimé !');
        }
        //Affichage
        $this->setRedirect('admin_config_enums_voir');
        $this->addParamRedirect('enumname', $enumname);
        return $this->afficher();
    }

    /**
     * PRIVE 
     * Permet de récupérer les classes utiles en fonction du type de l'enum
     * @param string $enumName
     * @param string $demandeur //Nom de la route ayant fait la demande
     * @return Array
     */
    private function recupererClasseEnum($enumName, $demandeur = null)
    {
        $resultat = null;
        switch($enumName)
        {
            case 'association':
                $resultat['enum'] = new EnumAssociationType();
                $resultat['enumClasse'] = EnumAssociationType::class;
                $resultat['enumTypeClasse'] = EnumAssociationTypeType::class;
            break;
            case 'entreprise':
                $resultat['enum'] = new EnumEntrepriseType();
                $resultat['enumClasse'] = EnumEntrepriseType::class;
                $resultat['enumTypeClasse'] = EnumEntrepriseTypeType::class;
            break;    
            case 'fonction':
                $resultat['enum'] = new Fonction();
                $resultat['enumClasse'] = Fonction::class;
                $resultat['enumTypeClasse'] = FonctionType::class;
            break;
            case 'statut':
                $resultat['enum'] = new Statut();
                $resultat['enumClasse'] = Statut::class;
                $resultat['enumTypeClasse'] = StatutType::class;
            break;
            case 'secteur':
                $resultat['enum'] = new Secteur();
                $resultat['enumClasse'] = Secteur::class;
                $resultat['enumTypeClasse'] = SecteurType::class;
            break;
            case 'categAnnuaire':
                $resultat['enum'] = new EnumCategAnnuaire();
                $resultat['enumClasse'] = EnumCategAnnuaire::class;
                $resultat['enumTypeClasse'] = EnumCategAnnuaireType::class;
            break;
            default:
                $this->setRedirect('admin_config_enum_choisir');
                $this->addParamRedirect('demandeur', $demandeur);
                $this->addParamRedirect('titre', 'TRANS: choisir le type de enum');                
            break;
        }
        return $resultat;
    }

    /**
     * PRIVE : GENERER 
     * @return void
     */
    private function genererFormulaire($redirection, $enumname, $enum = null): void
    {
        $parametres = $this->recupererClasseEnum($enumname, $redirection);
        if($enum == null)
        {
            $enum = $parametres['enum'];
        }
            //Formulaire                    
            $form = $this->createForm($parametres['enumTypeClasse'], $enum);
            if($this->formIsValid($form))
            {
                $this->manager->persist($enum);
                $this->manager->flush();
                // $this->addFlash('success', 'Le service '.$service->getNom()." a bien été créé !");
                $this->setRedirect($redirection);
                $this->addParamRedirect('enumname', $enumname);
            }
            //Affichage        
            $this->addParamTwig('form', $form->createView());                
    }
}