<?php

namespace App\Form;

use App\Form\OutilsType;
use App\SuperEntity\Contact;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ContactType extends OutilsType
{
    public function buildContactForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prive', CheckboxType::class,
            [
                'label_attr' => ['class' => 'switch-custom'],
                'label' => $this->addLabel('form.contact.prive'),
                'required' => false,
                'translation_domain' => 'false'
                // 'empty_data'=> false
                // 'data' => false
            ])
        ;
        return $builder;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
