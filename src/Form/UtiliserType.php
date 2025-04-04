<?php

namespace App\Form;

use App\Entity\Utiliser;
use App\Entity\eleve;
use App\Entity\projet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class UtiliserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_utiliser', DateType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir de rentrer une date valide',
                    ]),
                ],
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0;' // Ajoutez du style CSS directement
                ]
            ])
            ->add('projet', EntityType::class, [
                'class' => projet::class,
'choice_label' => 'id',
'attr' => [
    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
    'style' => 'background-color: #f0f0f0;' // Ajoutez du style CSS directement
]
            ])
            ->add('eleve', EntityType::class, [
                'class' => eleve::class,
'choice_label' => 'id',
'attr' => [
    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
    'style' => 'background-color: #f0f0f0;' // Ajoutez du style CSS directement
]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utiliser::class,
            'attr' => [
                'class' => 'forms-sample',
            ],
        ]);
    }
}
