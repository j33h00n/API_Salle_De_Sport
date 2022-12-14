<?php

namespace App\Form;

use App\Entity\Structures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StructuresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('adresse', TextType ::class, [
            'label' => 'Adresse',
            'attr' => [
                'class' => 'form-control',
                'minlength' => 2,
                'maxlength' => 100
            ],
            'label' => 'Adresse',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\Length(['min' =>2, 'max' =>100]),
                new Assert\NotBlank()

            ]
        ])
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary mt-4'
            ],
            'label' => 'Enregistrer'
        ]);
}

public function configureOptions(OptionsResolver $resolver): void
{
    $resolver->setDefaults([
        'data_class' => Structures::class,
    ]);
}
}
