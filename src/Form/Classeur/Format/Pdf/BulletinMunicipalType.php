<?php

namespace App\Form\Classeur\Format\Pdf;

use App\Form\PdfType;
use App\Form\FormatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Classeur\Format\Pdf\BulletinMunicipal;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BulletinMunicipalType extends FormatType
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
                'label' => $this->addLabel('form.pdf.bulletin.date'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('titre', TextType::class, 
            [
                'label' => $this->addLabel('form.pdf.bulletin.titre'),
                'required' => true              
            ])
            ->add('periode', TextType::class, 
            [
                'label' => $this->addLabel('form.pdf.bulletin.periode'),
                'required' => true              
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BulletinMunicipal::class,
        ]);
    }
}
