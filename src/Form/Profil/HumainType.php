<?php

namespace App\Form\Profil;

use App\Form\OutilsType;
use App\Entity\Profil\Humain;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class HumainType extends OutilsType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,
            [
                'label' => $this->addLabel('form.humain.nom'),
                'required' => true
            ])
            ->add('prenom', TextType::class,
            [
                'label' => $this->addLabel('form.humain.prenom'),
                'required' => false
            ])
            ->add('sexe', ChoiceType::class,
            [
                'label' => $this->addLabel('form.humain.sexe'),
                'choices'  => [
                    'form.humain.sexe.null' => null,
                    'form.humain.sexe.homme' => 'h',
                    'form.humain.sexe.femme' => 'f',
                ],
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Humain::class,
        ]);
    }
}
