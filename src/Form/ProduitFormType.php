<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class ProduitFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'constraints'  => [
                    new NotBlank(['message' => 'Ce champ est manquant.']),
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'Le nom ne peut contenir plus de 50 caractères.'
                    ])
                ]
            ])
            ->add('description',TextareaType::class, [
                'required'  => false
            ])
            ->add('prix', MoneyType::class, [
                'invalid_message' => 'Veuiller indiquer un prix',
                'constraints'  => [
                    new NotBlank(['message' => 'Ce champ est manquant.']),
                    new Positive(['message' => 'Le prix doit être positif'])
                ]
            ])
            ->add('quantite', IntegerType::class, [
                'constraints'  => [
                    new NotBlank(['message' => 'Ce champ est manquant.']),
                    new PositiveOrZero(['message' => 'La quantité ne peut pas être négative.'])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
