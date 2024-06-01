<?php

namespace App\Form;

use App\Entity\Equipement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


use App\Entity\Projet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class EquipementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
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
            ->add('date_ajout', DateType::class, [
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
                'class' => Projet::class,
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
            'data_class' => Equipement::class,
            'attr' => [
                'class' => 'forms-sample',
            ],
        ]);
    }
}
