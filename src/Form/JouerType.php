<?php

namespace App\Form;

use App\Entity\Jouer;
use App\Entity\eleve;
use App\Entity\quiz;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JouerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('score')
            ->add('date_jeu', null, [
                'widget' => 'single_text'
            ])
            ->add('id_eleve', EntityType::class, [
                'class' => eleve::class,
'choice_label' => 'id',
            ])
            ->add('id_quiz', EntityType::class, [
                'class' => quiz::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jouer::class,
        ]);
    }
}
