<?php

namespace App\Form;

use App\Entity\{Cards,Types,Factions};

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{FileType,IntegerType,TextType,TextareaType,EmailType,RepeatedType,CheckboxType,PasswordType,SubmitType};
use Symfony\Component\Validator\Constraints\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

//https://geekco.fr/blog/la-gestion-des-images-dans-un-projet-symfony
class CardsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom de la carte : '
            ])
            ->add('fullArt', CheckboxType::class, [
                'label'    => 'Mettre en full Art ? ',
                'required' => false
            ])
            ->add('image', FileType::class,[
                'label' => 'Image de la carte : ',
                'data_class' => null,
                "constraints" => [
                    new File([
                        "mimeTypes" => "image/*",
                        'mimeTypesMessage' => "Merci de fournir une image :p",
                    ])
                ],
                'required' => false
            ])
            ->add('description', TextareaType::class,[
                'label' => 'Description de la carte : '
            ])
            ->add('HP', IntegerType::class,[
                'label' => 'Nombre de pv : ',
                'required' => false
            ])
            ->add('attack', IntegerType::class,[
                'label' => 'Attaque : ',
                'required' => false
            ])
            ->add('shield', IntegerType::class,[
                'label' => 'Armure/Défense : ',
                'required' => false
            ])
            ->add('cost', IntegerType::class,[
                'label' => 'Coût de la carte : '
            ])
            ->add('id_type', EntityType::class, [
                'label' => 'Type de la carte : ',
                'class' => Types::class,
                'choice_label' => function (Types $type) {
                    return $type->getName();
                }
            ])
            ->add('id_faction', EntityType::class, [
                'label' => 'Faction de la carte : ',
                'class' => Factions::class,
                'choice_label' => function (Factions $faction) {
                    return $faction->getName();
                }
            ])
            ->add('save', SubmitType::class,[
                'label' => 'Enregistrer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cards::class,
        ]);
    }
}
