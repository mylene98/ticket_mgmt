<?php

namespace App\Form;

use App\Entity\Ticket;
use App\Entity\User;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;






class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('createdAt',DateTimeType::class,[
            'attr'=>[
                'class' => 'js-datepicker',
                'class'=> 'row',
                'class'=> ' form-control' ,                
                'class' => 'col-md-6', 
                
                'widget' => 'single_text',

                ],
                
                
            
           
            'label'=> 'Opened At'
               
           
            
            ]
            )
           ->add('Demandeur', EntityType::class,[
            'class' => User::class,
            'placeholder'=> '   ',
            'label'=> ' Requester  ',
            'attr'=>[
                'class'=> 'row',
        
                'class'=> ' form-control ',
                'class'=> 'col-md-4 mr-auto',
               
                
               
               ]
    
            ])
            
           
            ->add('assignedTo', EntityType::class,[
            'class' => User::class,
            'placeholder'=> '   ',
            
            
            'attr'=>[
                'class'=> 'row ' ,
                'class_label'=> 'Assigned To  ',
                'class'=> ' form-control ',
                'class'=> 'col-md-4',
               ]
            ])
           ->add('Category', EntityType::class,[
            'class' => Category::class,
            'placeholder'=> '   ',
            'attr'=>[
                'class'=> 'row',
                'class'=> ' form-control ',
                'class'=> 'col-4',
               ]
            
           
             
            
            

            ])
           ->add('Title' , TextType::class,[
            'attr'=>[
                'class'=> 'row',
                'class'=> ' form-control ',
                'class'=> 'col-4',
               ]
            
           ])

           
           ->add('type' ,ChoiceType::class,[
             
            'attr'=> [
                'class'=> 'row',
                'class'=> ' form-control ',
                'class'=> 'col-4',
                
            ],
           
            
           
            'choices' =>[
                'Demande' => 'demande',
                'Incident' => 'incident',
            ]
            
            
                
              
                
            
           ])
           ->add('priority', ChoiceType::class,[
            'attr'=>[
                'class'=> 'row',
                'class'=> ' form-control ',
                'class'=> 'col-4',
            ],
            'choices' => [
                'High' => 'high',
                'Medium' => 'medium',
                'Low' => 'low',

               

                
              
                
            ],

           ])
           ->add('status',ChoiceType::class,[
            
            
            'attr'=>[
                'class'=> 'row',
                'class'=> ' form-control ',
                'class'=> 'col-4',
               
            ],
           'choices' => [
                'New' => 'new',
                'In progress' => 'in progress',
                'low' => true,
              

                
              
                
            ],

           ])
            
            
            ->add('updatedAt',DateTimeType::class,[
                'attr'=>[
                    'class'=> 'row',
                    'class'=> ' form-control ',
                    'class'=> 'col-md-6',
                   ]])
           
            
            ->add('affectedAt',DateTimeType::class,[
                'attr'=>[
                    'class'=> 'row',
                    'class'=> ' form-control ',
                    'class'=> 'col-md-6',
                   ]])
           
            ->add('solution',CKEditorType::class,[
                
                'attr'=>[
                    'class'=> 'row',
                    'class'=> ' form-control ',
                    'class'=> 'col-md-6',
                   ]
                   
            ])
            
            ->add('description',CKEditorType::class
                
                    
                
                


            )
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-secondary mt-4'
                ]
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
