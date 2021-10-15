<?php

namespace App\Form;

use App\Entity\Classeur\Format\Image\Affiche;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AfficheType extends FormatType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder = $this->buildFormatForm($builder, $options);
        $builder
            ->add('support', ImageType::class,
            [
                'label' => false
            ])
            ->add('date', DateType::class, 
            [
                'label' => $this->addLabel('form.affiche.date'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('datefin', DateType::class, 
            [
                'label' => $this->addLabel('form.affiche.datefin'),
                'required' => false,
                "widget" => "single_text"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Affiche::class,
        ]);
    }
}
