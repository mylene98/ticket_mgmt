<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '255',
                    'placeholder'=> 'Name',
                ],
                'label' => 'FullName',
               
              
            ])
           
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '180',
                    'placeholder'=> 'exemple@gmail.com',
                ],
                'label' => 'Email Adress',
               
               
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder'=> '*********',
                    ],
                    'label' => 'Password',
                   
                ],
                'second_options' => [
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder'=> '*********',
                    ],
                    'label' => 'Confirm password',
                   
                ],
                'invalid_message' => 'Passwords do not match.'
            ])
            ->add('picture', UrlType::class, [
                'attr' => [
                    'placeholder'=>'URl of your avatar'
                    
                ],
                'label' => 'Profile picture',
               
               
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-secondary mt-4'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
