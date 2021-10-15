<?php

namespace App\Form\Agenda;

use App\Form\OutilsType;
use App\Entity\Agenda\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EvenementType extends OutilsType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class,
            [
                'label' => $this->addLabel('form.evenement.titre'),
                'required' => true
            ])
            ->add('lieu', TextType::class,
            [
                'label' => $this->addLabel('form.evenement.lieu'),
                'required' => false
            ])
            ->add('date', DateType::class, 
            [
                'label' => $this->addLabel('form.evenement.date.debut'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('heureDebut', TimeType::class, 
            [
                'label' => $this->addLabel('form.evenement.heure.debut'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('heureFin', TimeType::class, 
            [
                'label' => $this->addLabel('form.evenement.heure.fin'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('dateFin', DateType::class, 
            [
                'label' => $this->addLabel('form.evenement.date.fin'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('majeur', CheckboxType::class,
            [
                'label_attr' => ['class' => 'switch-custom'],
                'label' => $this->addLabel('form.evenement.majeur'),
                'required' => false,
                'translation_domain' => 'false',
                'data' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
