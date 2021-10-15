<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArchitectureController extends AbstractController
{
    /**
     * @Route("/architecture", name="architecture")
     */
    public function index(): Response
    {
        return $this->render('architecture/index.html.twig', [
            'controller_name' => 'ArchitectureController',
        ]);
    }
}
