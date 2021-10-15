<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Translation\TranslatableMessage;

class OutilsTests extends WebTestCase
{
    protected $client;
    protected $crawler;

    //Initialise un client
    protected function setUp():void
    {
        $this->client = static::createClient();         
    }

    // protected function trad($texte)
    // {
    //     $message = new TranslatableMessage($texte, [], 'messages'); 
    //     return $message->getMessage();
    // }

    //Permet de verifier que la page existe
    protected function assertPage200()
    {
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
    }

    protected function assertMessageSuccess()
    {
        $this->assertSame(1, $this->crawler->filter('#flash-success')->count());
    }

    //Permet la saisi d'une url dans le navigateur (et la connexion si besoin)
    protected function saisirUrl($url)
    {
        $this->crawler = $this->client->request('GET', $url);
        $this->login();
    }

    protected function login()
    {
        //Si le client n'est pas connecté, il est redirigé vers la page login
        if($this->client->getResponse()->getStatusCode() == 302)
        {
            $this->crawler = $this->client->followRedirect();
            //Le client rempli le formulaire de connexion et le valide
            $form = $this->crawler->selectButton('login_connexion')->form();
            $form['_username'] = 'jcarion';
            $form['_password'] = 'password';
            $this->client->submit($form);
            $this->crawler = $this->client->followRedirect();
        }
    }    

    // protected function recupAllIdOfEntity($class)
    // {
    //     $ids = array();
    //     $manager = $this->client->getContainer()->get("doctrine.orm.default_entity_manager");
    //     $repo = $manager->getRepository($class);
    //     $entitys = $repo->findAll();
    //     foreach($entitys as $entity)
    //     {
    //         array_push($ids, $entity->getId());
    //     }
    //     return $ids;
    // }

    protected function cliquerSurLien($texteDuLien)
    {
        $link = $this->crawler->selectLink($texteDuLien)->link();        
        $this->crawler = $this->client->click($link);
    }

    protected function majRedirect()
    {
        $this->crawler = $this->client->followRedirect();
    }

    protected function selectFormByButton($btn)
    {
        return $this->crawler->selectButton($btn)->form([]);
    }
}