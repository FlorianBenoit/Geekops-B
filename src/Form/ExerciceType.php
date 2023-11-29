<?php

namespace App\Form;

use App\Entity\Unity;
use App\Entity\Activity;
use App\Entity\Exercice;
use App\Entity\Quantity;
use App\Entity\Wod;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    $builder
        ->add('activity', EntityType::class, [
            'class' => Activity::class,
            'choice_label' => 'name', // Adjust this to the property you want to display
            'label' => 'Activity',
        ])
        ->add('quantity', EntityType::class, [
            'class' => Quantity::class,
            'choice_label' => 'number', // Adjust this to the property you want to display
        ])
        ->add('unity', EntityType::class, [
            'class' => Unity::class,
            'choice_label' => 'name', // Adjust this to the property you want to display
        ]);
        
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercice::class,
        ]);
    }
}
