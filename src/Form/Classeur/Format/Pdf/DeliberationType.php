<?php

namespace App\Form\Classeur\Format\Pdf;

use App\Form\PdfType;
use App\Form\FormatType;
use Symfony\Component\Form\AbstractType;
use App\Entity\Classeur\Format\Pdf\Deliberation;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DeliberationType extends FormatType
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
                'label' => $this->addLabel('form.pdf.deliberation.date'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('type', ChoiceType::class, 
            [
                'choices' => [
                    'Liste des délibérations' => 'b_liste',
                    'Délibération' => 'c_delib',
                    'Procès verbal de la réunion' => 'a_pv'
                ],
                'label' => $this->addLabel('form.pdf.deliberation.type'),
                'required' => false,                
            ])
            ->add('numero', TextType::class, 
            [
                'label' => $this->addLabel('form.pdf.deliberation.numero'),
                'required' => false              
            ])
            ->add('titre', TextType::class, 
            [
                'label' => $this->addLabel('form.pdf.deliberation.titre'),
                'required' => false              
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Deliberation::class,
        ]);
    }
}
