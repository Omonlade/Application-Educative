<?php

namespace App\Form;

use App\Entity\Reponse;
use App\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ReponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenu', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir un contenu valide',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0;' // Ajoutez du style CSS directement
                ]
            ])
            ->add('est_correcte', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir un nom valide',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0;' // Ajoutez du style CSS directement
                ]
            ])
            ->add('id_question', EntityType::class, [
                'class' => Question::class,
                'choice_label' => 'id',
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0;' // Ajoutez du style CSS directement
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reponse::class,
        ]);
    }
}
