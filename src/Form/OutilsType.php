<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Translation\TranslatableMessage;

class OutilsType extends AbstractType
{
    protected function codeTrad($message)
    {
        return new TranslatableMessage($message, [], 'messages');
    }    
    protected function addLabel($message)
    {
        return $this->codeTrad($message);
    }
}