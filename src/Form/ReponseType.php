<?php

namespace App\Form;

use App\Entity\Reponse;
use App\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

use Doctrine\ORM\EntityRepository;


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

            ->add('est_correcte', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],

                'multiple' => false,
                'expanded' => true,
                'attr' => [
                    'class' => 'form-control form-group',
                    'style' => 'background-color: #f0f0f0; margin-right: 10px;height:auto' // Ajoutez du style CSS directement
                ],
                'choice_attr' => function($choice, $key, $value) {
                    // ajoutez une marge à droite pour chaque choix
                    return ['style' => ' display:block; margin:2px'];
                },
            ])

            
            ->add('question', EntityType::class, [
                'class' => Question::class,
                'choice_label' => function (Question $question)
                {
                    // Formatage clair avec un tiret pour séparer le nom et la description
                    return $question->getQuestionnaire() ;
                },
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0; height: 66px !important;' // Ajoutez du style CSS directement
                ],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('question')
                        ->orderBy('question.id', 'DESC'); // Trie par ordre décroissant
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reponse::class,
            'attr' => [
                'class' => 'forms-sample',
            ],
        ]);
    }
}
