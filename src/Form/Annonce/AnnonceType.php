<?php

namespace App\Form\Annonce;

use App\Form\OutilsType;
use App\Entity\Annonce\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AnnonceType extends OutilsType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class,
            [
                'label' => $this->addLabel('form.annonce.titre'),
                'required' => true
            ])
            ->add('texte', TextType::class,
            [
                'label' => $this->addLabel('form.annonce.texte'),
                'required' => true
            ])
            ->add('debut', DateTimeType::class, 
            [
                'label' => $this->addLabel('form.annonce.debut'),
                'required' => true,
                "widget" => "single_text"                
            ])
            ->add('fin', DateTimeType::class, 
            [
                'label' => $this->addLabel('form.annonce.fin'),
                'required' => true,
                "widget" => "single_text"                
            ])
            ->add('couleur', TextType::class,
            [
                'label' => $this->addLabel('form.annonce.couleur'),
                'required' => false
            ])
            ->add('invisible')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
