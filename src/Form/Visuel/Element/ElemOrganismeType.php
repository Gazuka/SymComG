<?php

namespace App\Form\Visuel\Element;

use App\Form\OutilsType;
use App\Entity\Visuel\Element\ElemOrganisme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ElemOrganismeType extends OutilsType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('organisme')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ElemOrganisme::class,
        ]);
    }
}
