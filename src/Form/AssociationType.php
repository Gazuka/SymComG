<?php

namespace App\Form;

use App\Entity\Organisme\Association;
use App\Form\StructureType;
use App\Entity\Organisme\EnumAssociationType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AssociationType extends StructureType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder = $this->buildStructureForm($builder, $options);
        $builder        
            ->add('sigle', TextType::class,
            [
                'label' => $this->addLabel('form.association.sigle'),
                'required' => false
            ])    
            ->add('types', EntityType::class,
            [
                'class' => EnumAssociationType::class,
                'expanded' => true,
                'multiple' => true,
                'attr' => ['class' => 'form-check-inline']
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Association::class,
        ]);
    }
}
