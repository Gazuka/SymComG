<?php

namespace App\Form;

use App\Form\OutilsType;
use App\SuperEntity\Structure;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class StructureType extends OutilsType
{
    public function buildStructureForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,
            [
                'label' => $this->addLabel('form.structure.nom'),
                'translation_domain' => 'false',
                'required' => true
            ])
            ->add('presentation', CKEditorType::class,
            [
                'label' => $this->addLabel('form.structure.presentation'),
                'translation_domain' => 'false'
            ])
            ->add('local', CheckboxType::class,
            [
                'label_attr' => ['class' => 'switch-custom'],
                'label' => $this->addLabel('form.structure.local'),
                'required' => false,
                'translation_domain' => 'false',
                'data' => true
            ])
        ;   
        return $builder;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Structure::class,
        ]);
    }
}
