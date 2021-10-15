<?php

namespace App\Form;

use App\Entity\CarteVisite\Contact\Mail;
use App\Form\ContactType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class MailType extends ContactType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder = $this->buildContactForm($builder, $options);
        $builder
            ->add('courriel', EmailType::class,
            [
                'label' => $this->addLabel('form.mail.courriel'),
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mail::class,
        ]);
    }
}
