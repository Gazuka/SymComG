<?php

namespace App\Form\Classeur\Format\Pdf;

use App\Form\PdfType;
use App\Form\FormatType;
use Symfony\Component\Form\AbstractType;
use App\Entity\Classeur\Format\Pdf\ArreteMunicipal;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArreteMunicipalType extends FormatType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder = $this->buildFormatForm($builder, $options);
        $builder
            ->add('support', PdfType::class,
            [
                'label' => false
            ])
            ->add('date', DateType::class, 
            [
                'label' => $this->addLabel('form.pdf.arrete.date'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('datedebut', DateType::class, 
            [
                'label' => $this->addLabel('form.pdf.arrete.datedebut'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('datefin', DateType::class, 
            [
                'label' => $this->addLabel('form.pdf.arrete.datefin'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('titre', TextType::class, 
            [
                'label' => $this->addLabel('form.pdf.arrete.titre'),
                'required' => true              
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArreteMunicipal::class,
        ]);
    }
}
