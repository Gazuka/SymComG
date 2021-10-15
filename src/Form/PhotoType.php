<?php

namespace App\Form;

use App\Entity\Classeur\Format\Image\Photo;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PhotoType extends FormatType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('support', ImageType::class,
            [
                'label' => false
            ])
            ->add('date', DateType::class, 
            [
                'label' => $this->addLabel('form.photo.date'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('actualite', CheckboxType::class,
            [
                'label_attr' => ['class' => 'switch-custom'],
                'label' => $this->addLabel('form.photo.actualite'),
                'required' => false,
                'translation_domain' => 'false',
                'data' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Photo::class,
        ]);
    }
}
