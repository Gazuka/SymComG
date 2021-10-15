<?php

namespace App\Form\Classeur\Format\Image;

use App\Form\ImageType;
use App\Form\FormatType;
use Symfony\Component\Form\AbstractType;
use App\Entity\Classeur\Format\Image\Icone;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IconeType extends FormatType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('support', ImageType::class,
        [
            'label' => false
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Icone::class,
        ]);
    }
}
