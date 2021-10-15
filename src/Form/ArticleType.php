<?php

namespace App\Form;

use App\Form\OutilsType;
use App\Entity\Article\Article;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleType extends OutilsType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class,
            [
                'label' => $this->addLabel('form.article.titre'),
                'required' => true
            ])
            ->add('dateDebutPublication', DateType::class, 
            [
                'label' => $this->addLabel('form.article.date.debut.publication'),
                'required' => false,
                "widget" => "single_text"                
            ])
            ->add('dateFinPublication', DateType::class, 
            [
                'label' => $this->addLabel('form.article.date.fin.publication'),
                'required' => false,
                "widget" => "single_text"                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}