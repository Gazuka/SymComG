<?php

namespace App\Form\Visuel\Element;

use App\Form\OutilsType;
use App\Entity\Visuel\Element\ElemTexte;
use Symfony\Component\Form\AbstractType;
use App\Form\Visuel\Element\ElemDiapoType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ElemTexteType extends OutilsType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('html', CKEditorType::class,
        [
            'label' => $this->addLabel('form.element.texte.html'),
            'translation_domain' => 'false'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ElemTexte::class,
        ]);
    }
}
