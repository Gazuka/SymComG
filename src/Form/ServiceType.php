<?php

namespace App\Form;

use App\Entity\Organisme\Service;
use App\Form\StructureType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends StructureType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder = $this->buildStructureForm($builder, $options);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
