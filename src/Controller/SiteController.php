<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    /**
     * @Route("/site", name="site")
     */
    public function index(): Response
    {
        // $this->setTwig('pages/public/index.html.twig');
        // return $this->afficher();
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }
}
