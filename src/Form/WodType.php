<?php

namespace App\Form;

use App\Entity\Wod;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Unity;
use App\Entity\Activity;
use App\Entity\Category;

use App\Entity\Exercice;
use App\Entity\Quantity;
use App\Form\ExerciceType;
use App\Entity\WodRepetition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class WodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('image')
            ->add('created_at')
            ->add('description')
            ->add('status',CheckboxType::class, [
                'label' => 'Validate', // You can customize the label
                'required' => false, // This makes the checkbox optional
                            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'name',
            ])
            ->add('exercices', CollectionType::class, [
                'entry_type' => ExerciceType::class, // Use ExerciceType here
                'entry_options' => [
                    // If needed, you can pass options to the ExerciceType here
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
            ])
            ->add('repetition', EntityType::class, [
                'class' => WodRepetition::class,
                'choice_label' => 'repetition',
            ])
            ->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wod::class,
        ]);
    }
}