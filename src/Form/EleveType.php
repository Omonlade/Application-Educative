<?php

namespace App\Form;

use App\Entity\Eleve;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',  TextType::class, [
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

            ->add('prenom',  TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir un prenom valide',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0;' // Ajoutez du style CSS directement
                ]
            ])

            ->add('pseudo',  TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir un pseudo valide',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0;' // Ajoutez du style CSS directement
                ]
            ])

            ->add('date_naissance', null, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0;' // Ajoutez du style CSS directement
                ]
            ])
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'M' => 'M',
                    'F' => 'F',
                ],
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0;' // Ajoutez du style CSS directement
                ],
                'required' => true,
                'expanded' => false,
                'multiple' => false,
                'label' => 'Sexe'
            ])

            ->add('password',  PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Entrez au moins 8 caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0;' // Ajoutez du style CSS directement
                ],
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
            'attr' => [
                'class' => 'forms-sample',
            ],
        ]);
    }
}
