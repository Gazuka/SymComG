<?php
// echo $this->client->getResponse()->getContent(); // Affiche la page visible
namespace App\Tests\Controller;

use App\Tests\OutilsTests;

class AdminOrganismeControllerTest extends OutilsTests
{
    protected function setUp():void
    {
        parent::setUp();
    }

    public function structureProvider()
    {
        return array(
            array('Service'),
            array('Association'),
            array('Entreprise')            
        ); 
    }

    public function urlProvider()
    {
        return array(
            array('/admin'),            
            array('/site')
        );
    }

    /**
     * Vérifier si les pages sont bien accessibles
     * @dataProvider urlProvider
     */
    public function testdesPages($url)
    {
        $this->saisirUrl($url);
        $this->assertPage200();
    }

    /**
     * Vérifier l'affichage des différents listings de services
     * @dataProvider structureProvider
     */
    public function testAffichageServices($structure)
    {
        $this->saisirUrl('admin/organisme');
        $this->majRedirect();
        $this->cliquerSurLien($structure);
        $this->assertPage200();
    }

    /**
     * Vérifier la création, modification, suppression des services
     * @dataProvider structureProvider
     */
    public function testOrganisme($structure)
    {
        //On débute sur la page d'accueil de l'admin
        $this->saisirUrl('admin');
        $this->assertPage200();
        //On clique sur "Créer un nouvel organisme" ce qui nous redirige vers une page de choix
        $this->cliquerSurLien("Créer un nouvel organisme");
        $this->majRedirect();
        $this->assertPage200();
        //On clique sur l'un des choix
        $this->cliquerSurLien($structure);
        $this->assertPage200();
        //On rempli le formulaire
        $form = $this->remplirFormulaireStructure($structure, 'Enregistrer');
        //Le client valide le formulaire
        $this->crawler = $this->client->submit($form);
        $this->crawler = $this->client->followRedirect();
        $this->assertMessageSuccess();
        //On clique sur le bouton "Modifier"
        $this->cliquerSurLien("Modifier");
        $this->assertPage200();
        //On rempli le formulaire
        $form = $this->remplirFormulaireStructure($structure, 'Enregistrer');
        //Le client valide le formulaire
        $this->crawler = $this->client->submit($form);
        $this->crawler = $this->client->followRedirect();
        $this->assertMessageSuccess();
        //On clique sur le bouton "Ajouter une carte de visite"
        $this->cliquerSurLien("Ajouter une carte de visite");
        $this->majRedirect();
        $this->assertPage200();
        //Supprimer la structure
        $this->cliquerSurLien("Supprimer");
        $this->majRedirect();
        $this->assertMessageSuccess();
        $this->assertPage200();
    }

    /**
     * Insertion de données dans les différents formulaires
     */
    private function remplirFormulaireStructure($structure, $btn)
    {
        $form = null;
        switch($structure)
        {
            case 'Association':
                $form = $this->selectFormByButton('Enregistrer');
                $form['association[nom]'] = 'Test en cours';
                $form['association[local]'] = true;
                $form['association[sigle]'] = 'SIG';
            break;
            case 'Entreprise':
                $form = $this->selectFormByButton('Enregistrer');
                $form['entreprise[nom]'] = 'Test en cours';
                $form['entreprise[local]'] = true;
            break;
            case 'Service':
                $form = $this->selectFormByButton('Enregistrer');
                $form['service[nom]'] = 'Test en cours';
                $form['service[local]'] = true;
            break;
        }
        return $form;
    }
}
