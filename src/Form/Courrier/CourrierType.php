<?php

namespace App\Form\Courrier;

use App\Form\OutilsType;
use App\Entity\Courrier\Courrier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CourrierType extends OutilsType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('objet', TextType::class,
            [
                'label' => $this->addLabel('Objet'),
                'required' => true
            ])
            ->add('message', TextAreaType::class,
            [
                'label' => $this->addLabel('Message'),
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Courrier::class,
        ]);
    }
}
