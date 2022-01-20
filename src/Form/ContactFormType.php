<?php

namespace App\Form;

use App\Entity\Contact;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'homepage'
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
