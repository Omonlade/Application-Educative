<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Quiz;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;


class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('questionnaire',  TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir un questionnaire valide',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0;' // Ajoutez du style CSS directement
                ]
            ])
            ->add('quiz', EntityType::class, [
                'class' => quiz::class,
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
            'data_class' => Question::class,
            'attr' => [
                'class' => 'forms-sample',
            ],
        ]);
    }
}
