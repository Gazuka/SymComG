<?php

namespace App\Form\Visuel\Element;

use App\Form\OutilsType;
use App\Entity\Visuel\Element\ElemTitre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ElemTitreType extends OutilsType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('titre', TextType::class,
        [
            'label' => $this->addLabel('form.element.titre.titre'),
            'translation_domain' => 'false'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ElemTitre::class,
        ]);
    }
}
