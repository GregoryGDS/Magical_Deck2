<?php

namespace App\Form;

use App\Entity\Users;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{DateType, EmailType, PasswordType, RepeatedType, SubmitType, TextType};

class UsersType extends AbstractType
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
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe : '],
                'second_options' => ['label' => "Répéter le mot de passe : "],
            ])
            ->add('save', SubmitType::class,[
                'label' => 'Enregistrer',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
