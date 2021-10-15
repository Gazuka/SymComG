<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormatType extends OutilsType
{
    public function buildFormatForm(FormBuilderInterface $builder, array $options)
    {
        // $builder
        //     ->add('prive', CheckboxType::class,
        //     [
        //         'label_attr' => ['class' => 'switch-custom'],
        //         'label' => $this->addLabel('form.contact.prive'),
        //         'required' => false,
        //         'translation_domain' => 'false'
        //         // 'empty_data'=> false
        //         // 'data' => false
        //     ])
        // ;
        return $builder;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Format::class,
        ]);
    }
}
