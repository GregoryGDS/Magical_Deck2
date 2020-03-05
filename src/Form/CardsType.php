<?php

namespace App\Form;

use App\Entity\{Cards,Types,Factions};

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{IntegerType,TextType,EmailType,RepeatedType,CheckboxType,PasswordType,SubmitType};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CardsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom de la carte : ',
            ])
            ->add('description', TextType::class,[
                'label' => 'Description de la carte : ',
            ])
            ->add('HP', IntegerType::class,[
                'label' => 'Nombre de pv : ',
            ])
            ->add('attack', IntegerType::class,[
                'label' => 'Attaque : ',
            ])
            ->add('shield', IntegerType::class,[
                'label' => 'Armure/Défense : ',
            ])
            ->add('cost', IntegerType::class,[
                'label' => 'Coût de la carte : ',
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
