<?php

namespace App\Form\Classeur\Format\Pdf;

use App\Form\PdfType;
use App\Form\FormatType;
use Symfony\Component\Form\AbstractType;
use App\Entity\Classeur\Format\Pdf\Deliberation;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Deliberation::class,
        ]);
    }
}
