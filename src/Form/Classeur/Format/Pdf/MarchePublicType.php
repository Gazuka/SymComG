<?php

namespace App\Form\Classeur\Format\Pdf;

use App\Form\PdfType;
use App\Form\FormatType;
use Symfony\Component\Form\AbstractType;
use App\Entity\Classeur\Format\Pdf\MarchePublic;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MarchePublicType extends FormatType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder = $this->buildFormatForm($builder, $options);
        $builder
            ->add('support', PdfType::class,
            [
                'label' => false
            ])
            ->add('datedebut', DateType::class, 
            [
                'label' => $this->addLabel('form.pdf.marchepublic.datedebut'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('datefin', DateType::class, 
            [
                'label' => $this->addLabel('form.pdf.marchepublic.datefin'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('titre', TextType::class, 
            [
                'label' => $this->addLabel('form.pdf.marchepublic.titre'),
                'required' => true              
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MarchePublic::class,
        ]);
    }
}
