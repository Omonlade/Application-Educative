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

use Doctrine\ORM\EntityRepository;


class QuestionType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add('questionnaire', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir un questionnaire valide',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0;', // Ajoutez du style CSS directement
                ],
            ])

            ->add('quiz', EntityType::class, [
                'class' => Quiz::class,
                'choice_label' => 'id',
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0;', // Ajoutez du style CSS directement
                ],
                'choice_label' => function (Quiz $quiz) {
                    // Formatage clair avec un tiret pour séparer le nom et la description
                    return $quiz->getLibelle() ;
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('quiz')
                        ->orderBy('quiz.id', 'DESC'); // Trie par ordre décroissant
                }
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
