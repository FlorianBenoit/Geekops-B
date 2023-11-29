<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'user' => 'ROLE_USER',
                    'admin' => 'ROLE_ADMIN',
                    // Add other available roles here
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('mail')
            ->add('avatar');
    
        // If it's an existing user, make the password field not required
        if (!$options['isNew']) {
            $builder->add('password', PasswordType::class, [
                'required' => false,
                'mapped' => true, // Map to the User entity
                'empty_data' => '', // Allow an empty string for an existing user
            ]);
        } else {
            // If it's a new user, include the password field with required validation
            $builder->add('password', PasswordType::class, [
                'required' => true,
                'mapped' => true, // Map to the User entity
            ]);
        }
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'isNew' => true
        ]);
    }
}
