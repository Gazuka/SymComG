<?php

namespace App\Controller;

use App\Entity\CarteVisite\Contact\Mail;
use App\Form\MailType;
use App\Entity\CarteVisite\Contact\Adresse;
use App\Entity\CarteVisite\Contact\Telephone;
use App\Form\AdresseType;
use App\Entity\CarteVisite\CarteVisite;
use App\Form\TelephoneType;
use App\Controller\AdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCarteVisiteController extends AdminController
{
    const CHOIX_POSSIBLES =  [
                                'adresse' => 'admin.cartevisite.choisir.adresse',
                                'mail' => 'admin.cartevisite.choisir.mail',
                                'telephone' => 'admin.cartevisite.choisir.telephone',
                                'facebook' => 'admin.cartevisite.choisir.facebook'
                            ];

    /**
     * PUBLIC : CREER - Permet de créer un nouveau contact (telephone, mail, adresse...)
     * 
     * @Route("/admin/cartevisite/creer/{idcartevisite}/{contactName?}", name="admin_cartevisite_creer", requirements={"idcartevisite"="\-?[0-9]+"})
     * @param string $contactName //Nom du type de contact à créer (telephone, mail, adresse...)
     * @return Response
     */
    public function creerContact($idcartevisite, $contactName = null): Response
    {
        $this->genererFormulaire($contactName, $idcartevisite);        
        return $this->afficher('admin.cartevisite.creer.titre.'.$contactName);
    }

    /**
     * PUBLIC : EDITER - Editer un contact
     * @Route("/admin/cartevisite/editer/{contactName}/{idcontact}", name="admin_cartevisite_editer", requirements={"idcontact"="\-?[0-9]+"})
     * @param string $contactName //Nom du type de contact à créer (telephone, mail, adresse...)
     * @param integer $idcontact
     * @return Response
     */
    public function editerContact(int $idcontact, string $contactName):Response
    {
        //On récupére les parametres requis en fonction du type de contact
        $parametres = $this->recupererClasseContact($contactName);
        //Récupérer le contact
        $contact = $this->findById($parametres['contactClasse'], $idcontact);
        //Préparation du formulaire
        $this->genererFormulaire($contactName, $contact->getCarteVisite()->getId(), $contact);
        return $this->afficher('admin.cartevisite.editer.titre.'.$contactName);
    }

    /**
     * PUBLIC : SUPPRIMER - Supprimer un contact
     * 
     * @Route("/admin/cartevisite/supprimer/{contactName}/{idcontact}", name="admin_cartevisite_contact_supprimer", requirements={"idcontact"="\-?[0-9]+"})
     * @param integer $idcontact
     * @return Response
     */
    public function supprimerContact(int $idcontact, string $contactName):Response
    {
        //On récupére les parametres requis en fonction du type de contact
        $parametres = $this->recupererClasseContact($contactName);
        $contact = $this->findById($parametres['contactClasse'], $idcontact);
        $carteVisite = $contact->getCarteVisite();
        //Supprimer de la BDD
        $this->supprimer($parametres['contactClasse'], $idcontact);
        //Message
        $this->addFlash('success', 'admin.cartevisite.'.$contactName.'.supprimer.flash.success');
        //Affichage        
        $this->redirectParent($carteVisite);
        return $this->afficher();
    }

    /**
     * PRIVE 
     * Permet de récupérer les classes utiles en fonction du type de contact
     * @param string $contactName //Nom du type de contact à afficher (mail, telephone, adresse...)
     * @param string $demandeur //Nom de la route ayant fait la demande
     * @return Array
     */
    private function recupererClasseContact($contactName)
    {
        $resultat = null;
        switch($contactName)
        {
            case 'telephone':
                $resultat['contact'] = new Telephone();
                $resultat['contactClasse'] = Telephone::class;
                $resultat['contactTypeClasse'] =  TelephoneType::class;
            break;
            case 'adresse':
                $resultat['contact'] = new Adresse();
                $resultat['contactClasse'] = Adresse::class;
                $resultat['contactTypeClasse'] =  AdresseType::class;
            break;
            case 'mail':
                $resultat['contact'] = new Mail();
                $resultat['contactClasse'] = Mail::class;
                $resultat['contactTypeClasse'] =  MailType::class;
            break;
            default:
                $demandeur = 'demandeurDeContact';
                $this->setRedirect('admin_choisir');
                $this->addParamRedirect('demandeur', $demandeur);
                //Enregistrer les infos dans la session pour le retour ici après le traitement
                $this->sessionService->enregistrerVariable('choixPossibles', $this->preparerChoix(self::CHOIX_POSSIBLES));
                $this->sessionService->enregistrerVariable('nomDuChoix', 'contactName');                
                $this->sessionService->enregistrerCheminActuel($demandeur);                
                $this->addParamRedirect('titre', $this->codeTrad('admin.cartevisite.contact.choisir'));
            break;
        }
        return $resultat;
    }

    /**
     * PRIVE : GENERER - Génère un formulaire en fonction du type de contact (mail, telephone, Adresse...)
     * @param string $contactName //Nom du type de contact à afficher (mail, telephone, Adresse...)
     * @param string $demandeur //Nom de la route ayant fait la demande
     * @param object $contact //Objet qui sera édité si c'est un formulaire d'édition
     * @return void
     */
    private function genererFormulaire($contactName, $idcartevisite, $contact = null): void
    {
        $parametres = $this->recupererClasseContact($contactName);
        if($parametres != null)
        {
            if($contact == null)
            {
                $contact = $parametres['contact'];
            }
            //Formulaire        
            $form = $this->createForm($parametres['contactTypeClasse'], $contact);
            if($this->formIsValid($form))
            {
                if($contact->getCarteVisite() == null)
                {
                    $carteVisite = $this->findById(CarteVisite::class, $idcartevisite);                    
                    $contact->setCarteVisite($carteVisite);                                       
                }                
                $this->manager->persist($contact);
                $this->manager->flush();
                //Redirige vers la page de gestion du parent
                $this->redirectParent($carteVisite);
                $this->addFlash('success', 'admin.cartevisite.form.flash.success.'.$contactName);
            }
            //Affichage        
            $this->setTwig('pages/admin_cartevisite/page____admin_cartevisite____cartevisite____form.html.twig');
            $this->addParamTwig('typeContact', $this->get_class_name(get_class($contact)));
            $this->addParamTwig('form', $form->createView());
        }
    }

    private function redirectParent($carteVisite)
    {
        $parent = $carteVisite->getParent();
        dump($carteVisite);
        $this->setRedirect('admin_'.$parent['nom'].'_gerer');
        $this->addParamRedirect('id'.$parent['nom'], $parent['objet']->getId());
    }
}