<?php

namespace App\Form;

use App\Entity\Contact;
use Gregwar\CaptchaBundle\Type\CaptchaType;
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
            ->add('captcha', CaptchaType::class, [
                'label' => false,
                'required' => true,
                'invalid_message' => 'Le code tapé ne correspond pas au Captcha',
                'attr' => [
                    'class' => 'form-control-input mt-4',
                    'placeholder' => 'Code'
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
