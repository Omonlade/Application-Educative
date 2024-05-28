<?php

namespace App\Form;

use App\Entity\Consulter;
use App\Entity\eleve;
use App\Entity\projet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsulterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_eleve', EntityType::class, [
                'class' => eleve::class,
'choice_label' => 'id',
            ])
            ->add('id_projet', EntityType::class, [
                'class' => projet::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Consulter::class,
        ]);
    }
}
