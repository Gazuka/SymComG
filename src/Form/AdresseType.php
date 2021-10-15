<?php

namespace App\Form;

use App\Entity\CarteVisite\Contact\Adresse;
use App\Form\ContactType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class AdresseType extends ContactType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder = $this->buildContactForm($builder, $options);
        $builder
            ->add('numero', TextType::class,
            [
                'label' => $this->addLabel('form.adresse.numero'),
                'required' => false
            ])
            ->add('rue1', TextType::class,
            [
                'label' => $this->addLabel('form.adresse.rue1'),
                'required' => false
            ])
            ->add('rue2', TextType::class,
            [
                'label' => $this->addLabel('form.adresse.rue2'),
                'required' => false
            ])
            ->add('codePostal', NumberType::class,
            [
                'label' => $this->addLabel('form.adresse.codePostal'),
                'required' => false
            ])
            ->add('ville', TextType::class,
            [
                'label' => $this->addLabel('form.adresse.ville'),
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
