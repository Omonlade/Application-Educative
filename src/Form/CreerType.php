<?php

namespace App\Form;

use App\Entity\Creer;
use App\Entity\quiz;
use App\Entity\user;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_creation', null, [
                'widget' => 'single_text'
            ])
            ->add('id_user', EntityType::class, [
                'class' => user::class,
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
            'data_class' => Creer::class,
        ]);
    }
}
