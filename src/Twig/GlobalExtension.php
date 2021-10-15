<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;
use Symfony\Contracts\Translation\TranslatorInterface;

class GlobalExtension extends AbstractExtension
{
    private $traducteur;

    public function __construct(TranslatorInterface $translator)
    {
        //Service traducteur
        $this->traducteur = $translator;
    }
    
    protected function trad($texte)
    {
        return $this->traducteur->trans($texte, [], 'messages');
    }
}