<?php

namespace App\Form;

use App\Entity\Organisme\Entreprise;
use App\Form\StructureType;
use App\Entity\Organisme\EnumEntrepriseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends StructureType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder = $this->buildStructureForm($builder, $options);
        $builder     
            ->add('types', EntityType::class,
            [
                'class' => EnumEntrepriseType::class,
                'expanded' => false,
                'multiple' => true,
                'attr' => ['class' => 'form-check-inline']
            ]    
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
