<?php

namespace App\Form\Visuel\Element;

use App\Form\OutilsType;
use App\Form\Classeur\ClasseurType;
use App\Entity\Visuel\Element\ElemDiapo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ElemDiapoType extends OutilsType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('classeur', ClasseurType::class,
            [
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ElemDiapo::class,
        ]);
    }
}
