<?php

namespace App\Form;

use App\Entity\Projet;
use App\Entity\Tutoriel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Doctrine\ORM\EntityRepository;


use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add('nom', TextType::class, [
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
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir une description valide',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-control form-group', // Assurez-vous que vos classes CSS sont correctes
                    'style' => 'background-color: #f0f0f0;', // Vous pouvez ajouter du style CSS directement ici
                    'rows' => 5, // Nombre de lignes dans le textarea
                ]
            ])
            ->add('image', FileType::class,[
                "required" =>false,
                "attr" =>[
                    "class" => "form-control file-upload-info",
                    "id" =>"validatedCustomFile"
                ],
                "constraints" => new File([
                    "maxSize"=>"10M",
                    "mimeTypes" => [
                        "image/jpeg",
                        "image/jpg",
                        "image/png",
                        "image/webp",
                    ],
                    "mimeTypesMessage" => "Seules les images JPEG, JPG  PNG, webp sont autorisées"
                ]),
                'data_class' => null
            ])
            ->add('date_creation', DateType::class, [
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

            ->add('tutoriel', EntityType::class, [
                'class' => Tutoriel::class,
                'choice_label' => function (Tutoriel $tutoriel) {
                    return 'TITRE: ' . $tutoriel->getTitre() . '  ||  DESCRIPTION: ' . $tutoriel->getDescription();
                },
                'attr' => [
                    'class' => 'form-control form-group',
                    'style' => 'background-color: #f0f0f0; height: 66px !important;',
                ],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tutoriel')
                        ->leftJoin('App\Entity\Projet', 'projet', 'WITH', 'projet.tutoriel = tutoriel')
                        ->where('projet.tutoriel IS NULL')
                        ->orderBy('tutoriel.id', 'DESC');
                }
            ])

            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
            'attr' => [
                'class' => 'forms-sample',
            ],
        ]);
    }
}
