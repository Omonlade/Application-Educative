<?php

namespace App\Form;

use App\Entity\Projet;
use App\Entity\equipement;
use App\Entity\tutoriel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add('nom')
            ->add('description')
            ->add('date_creation', null, [
                'widget' => 'single_text',
            ])

            ->add('id_tutoriel', EntityType::class, [
                'class' => tutoriel::class,
                'choice_label' => 'id',
            ])
            ->add('id_equipement', EntityType::class, [
                'class' => equipement::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
