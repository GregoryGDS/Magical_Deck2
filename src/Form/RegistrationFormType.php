<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\{AbstractType,FormBuilderInterface};
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\{IsTrue,Length,NotBlank};
use Symfony\Component\Form\Extension\Core\Type\{TextType,EmailType,RepeatedType,CheckboxType,PasswordType};

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('firstName', TextType::class,[
                    'label' => 'Prénom : ',
                ])
                ->add('lastName', TextType::class,[
                    'label' => 'Nom : ',
                ])
                ->add('email', EmailType::class,[
                    'label' => 'Email : ',
                ])       
                ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            /*
            ->add('password', RepeatedType::class, ['type' =>PasswordType::class,
                'first_options' => [
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                    'label' => "Mot de passe : ",
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                        ]),                     
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),                   
                    ],
                ],
                'second_options' => [
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                    'label' => "Confirmer le Mot de passe : ",
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a confirmation',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                ],   
            ])
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
