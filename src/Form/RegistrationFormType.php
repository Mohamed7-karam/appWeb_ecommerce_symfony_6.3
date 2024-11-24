<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('full_name', TextType::class,[
                'label' =>false,
                'attr' =>[
                    'placeholder'=>'Enter your Full Name',
                    'class'=>'form-control'
                ],
                'row_attr'=> [
                    'class'=>'form-group mb-3'
                ]
            ])
            ->add('email', EmailType::class,[
                'label' =>false,
                'attr' =>[
                    'placeholder'=>'Enter your Email',
                    'class'=>'form-control'
                ],
                'row_attr'=> [
                    'class'=>'form-group mb-3'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'attr'=>[
                    "class" => 'form-check-input'
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'row_attr'=>[
                    'class' =>'custome-checkbox d-flex gap-2'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ])
                ],
                'first_options'=>[
                        'label' =>false,
                        'attr' =>[
                            'placeholder'=>'Your Password please...',
                            'class'=>'form-control'
                        ],
                        'row_attr'=> [
                            'class'=>'form-group mb-3'
                        ]
                    ],
                'second_options'=>[
                        'label' =>false,
                        'attr' =>[
                            'placeholder'=>'Confirm Your Password please...',
                            'class'=>'form-control'
                        ],
                        'row_attr'=> [
                            'class'=>'form-group mb-3'
                        ]
                    ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
