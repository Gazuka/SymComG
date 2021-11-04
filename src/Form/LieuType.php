<?php

namespace App\Form;

use App\Form\OutilsType;
use App\Entity\Lieu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LieuType extends OutilsType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,
            [
                'label' => $this->addLabel('form.lieu.nom'),
                'required' => true
            ])
            ->add('parent')
            // ->add('organisme')
            // ->add('carteVisite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lieu::class,
        ]);
    }
}
