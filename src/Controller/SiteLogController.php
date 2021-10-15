<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SiteLogController extends AbstractController
{
    /**
     * @Route("/site/login", name="site_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $pseudo = $utils->getLastUsername();

        return $this->render('interfaces/admin/_log.html.twig', [
            'hasError' => $error !== null,
            'pseudo' => $pseudo
        ]);
    }

    /**
     * Permet de se déconnecter
     *
     * @Route("/site/logout", name="site_logout")
     * @return void
     */
    public function logout():void
    {

    }
}
