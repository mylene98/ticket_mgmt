<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



use Symfony\Component\Validator\Constraints as Assert;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlength' => '2',
                'maxlength' => '255'
            ],
            'label' => 'Name',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\Length(['min' => 2, 'max' => 255]),
                new Assert\NotBlank()
            ]
        ])

     
        ->add('Description', TextareaType::class,[
            'attr' => [
                'class' => 'form-control',
                'minlength' => '2',
                'maxlength' => '255'
            ],
            'label' => 'Description',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\Length(['min' => 2, 'max' => 255]),
                new Assert\NotBlank()
            ]
            
            ]
            )
            ->add('submit', 
            submitType::class, [
                'attr' => [
                    'class' => 'btn btn-secondary mt-4'
                ]
                
                ]);}
            
            
    
        
        
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
