<?php

namespace App\Form;

use App\Entity\Tutoriel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class TutorielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir un  titre',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0;' // Ajoutez du style CSS directement
                ]
            ])

            ->add('description', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir une description',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-control form-group ', // Ajoutez vos classes CSS ici
                    'style' => 'background-color: #f0f0f0;' // Ajoutez du style CSS directement
                ]
            ])
            
            ->add('video', FileType::class,[
                "required" =>false,
                "attr" =>[
                    "class" => "form-control file-upload-info",
                ],
                "constraints" => new File([
                    'maxSize' => '2048M',  // Assurez-vous que cette valeur est suffisamment grande
                    "mimeTypes" => [
                        'video/mp4',
                        'video/avi', 
                        'video/mpeg', 
                        'video/quicktime',
                    ],
                    "mimeTypesMessage" => "Seules les video mp4, avi, mpeg, quicktime sont autorisées"
                ]),
                'data_class' => null
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tutoriel::class,
            'attr' => [
                'class' => 'forms-sample',
            ],
        ]);
    }
}
