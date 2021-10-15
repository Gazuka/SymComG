<?php

namespace App\Form;

use App\Entity\CarteVisite\Contact\Telephone;
use App\Form\ContactType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TelephoneType extends ContactType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder = $this->buildContactForm($builder, $options);
        $builder
            ->add('numero', TelType::class,
            [
                'label' => $this->addLabel('form.telephone.numero'),
                'required' => true
            ])
            ->add('nom', TextType::class,
            [
                'label' => $this->addLabel('form.telephone.nom'),
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Telephone::class,
        ]);
    }
}
