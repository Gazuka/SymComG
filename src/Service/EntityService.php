<?php

namespace App\Service;

use App\Service\RepoService;
use App\Entity\Organisme\Service;
use App\Entity\Organisme\Organisme;
use App\Entity\Organisme\Entreprise;
use App\Entity\Organisme\Association;
use App\Entity\Visuel\Element\ElemDiapo;
use Doctrine\ORM\EntityManagerInterface;

class EntityService {
    
    private $repoService;
    private $entity; //Objet
    private $classe; //Entity::class
    private $typeClasse; //EntityType::class

    public function __construct()
    {
    }

    private function actualiser()
    {
        $this->entity = null;
        $this->classe = null;
        $this->typeClasse = null;
    }

    public function setName($name)
    {
        $this->actualiser();
        switch($name)
        {
            case 'association':
                $this->entity = new Association();
                $this->classe = Association::class;
                $this->typeCLasse =  AssociationType::class;
            break;
            case 'service':
                $this->entity = new Service();
                $this->classe = Service::class;
                $this->typeCLasse =  ServiceType::class;
            break;
            case 'entreprise':
                $this->entity = new Entreprise();
                $this->classe = Entreprise::class;
                $this->typeCLasse =  EntrepriseType::class;
            break;
            case 'organisme':
                $this->entity = new Organisme();
                $this->classe = Organisme::class;                
            break;
            case 'elemDiapo':
                $this->entity = new ElemDiapo();
                $this->classe = ElemDiapo::class;                
            break;
        }
        return $this;
    }

    public function getClasse() 
    {
        return $this->classe;
    }

    public function setRepoService(RepoService $repoService)
    {
        $this->repoService = $repoService;
    }

    public function getEntity($id = null)
    {
        if($id == null)
        {
            $entity = $this->entity;    
        }
        else
        {
            $entity = $this->repoService->findById($this->classe, $id);
        }
        return $entity;
    }
}