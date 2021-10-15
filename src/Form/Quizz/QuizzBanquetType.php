<?php

namespace App\Form\Quizz;

use App\Form\OutilsType;
use App\Entity\Quizz\QuizzBanquet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class QuizzBanquetType extends OutilsType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,
            [
                'label' => $this->addLabel('Nom'),
                'required' => true
            ])
            ->add('prenom', TextType::class,
            [
                'label' => $this->addLabel('Prénom'),
                'required' => true
            ])         
            ->add('dateNaissance', DateType::class, 
            [
                'label' => $this->addLabel('Date de naissance'),
                'required' => true,
                "widget" => "single_text"                
            ])
            ->add('numCarteIdentite', TextType::class,
            [
                'label' => $this->addLabel("Numéro de carte d'identité"),
                'required' => true
            ])
            ->add('nom2', TextType::class,
            [
                'label' => $this->addLabel('Nom'),
                'required' => false
            ])
            ->add('prenom2', TextType::class,
            [
                'label' => $this->addLabel('Prénom'),
                'required' => false
            ])         
            ->add('dateNaissance2', DateType::class, 
            [
                'label' => $this->addLabel('Date de naissance'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('numCarteIdentite2', TextType::class,
            [
                'label' => $this->addLabel("Numéro de carte d'identité"),
                'required' => false
            ])        
            ->add('adresse', TextType::class,
            [
                'label' => $this->addLabel('Adresse'),
                'required' => true
            ])
            ->add('numBus', ChoiceType::class,
            [
                'label' => $this->addLabel('Choix du moyen de transport'),
                'choices'  => [
                    'Je viendrais par mes propres moyens' => 0,
                    'Bus : Hôtel de ville' => 1,
                    'Bus : Cimetière (parking situé en face)' => 2,
                    'Bus : Entrée du Parc Pécourt (rue Y. Gagarine)' => 3,
                    'Bus : Rue de Bougival (près du panneau électoral)' => 4,
                    'Bus : Aux feux tricolores, rue de Sèvres' => 5,
                    'Bus : Face au TUB' => 6,
                    'Bus : Foyer "Les jours heureux"' => 7,
                    'Bus : Ecole de musique' => 8,
                ],
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => QuizzBanquet::class,
        ]);
    }
}
