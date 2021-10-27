<?php

namespace App\Form;

use App\Entity\QuoteRequest;
use App\Validator\Telephone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuoteRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control-input',
                    'placeholder' => 'Nom et Prénom'
                ]
            ])
            ->add('company', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control-input',
                    'placeholder' => 'Société'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control-input',
                    'placeholder' => 'Téléphone'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control-input',
                    'placeholder' => 'E-Mail'
                ]
            ])
            ->add('website', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control-input',
                    'placeholder' => 'Site Web actuel si vous en avez un'
                ]
            ])
            ->add('pack', ChoiceType::class, [
                'label' => false,
                'required' => true,
                'expanded' => false,
                'multiple' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
                'choices' => [
                    'My Web Light' => 'my-web-light',
                    'My Web Plus' => 'my-web-plus',
                    'My Web Full' => 'my-web-full',
                ]
            ])
            ->add('options', ChoiceType::class, [
                'label' => false,
                'required' => true,
                'expanded' => true,
                'multiple' =>true,
                'attr' => [
                    'class' => 'form-control-checkbox'
                ],
                'choices' => [
                    'CMS' => 'cms',
                    'Outils Analytiques' => 'analytics',
                    'Newsletter' => 'newsletter',
                    'Blog' => 'blog',
                    'E-Commerce' => 'e-commerce',
                    'Multi-Langues' => 'multilingual',
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control-input',
                    'placeholder' => 'Décrivez votre idée de projet',
                    'cols' => 45,
                    'rows' => 8
                    ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => QuoteRequest::class,
        ]);
    }
}
