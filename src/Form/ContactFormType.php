<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control-input',
                    'placeholder' => 'Nom'
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
            ->add('subject', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control-input',
                    'placeholder' => 'Sujet'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control-input',
                    'placeholder' => 'Message',
                    'cols' => 45,
                    'rows' => 8
                ]
            ])
            ->add('robotCheckBox', CheckboxType::class, [
                'label' => 'Je ne suis pas une machine.',
                'required' => true,
                'attr' => [
                    'class' => 'form-control-checkbox'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
