<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Membre' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN'
                ],
                'expanded' => true,
                'multiple' => true,

            ])
            // ->add('password')
            // ->add('pseudo')
            // ->add('nom')
            // ->add('prenom')
            // ->add('civilite')
            // ->add('statut')
            // ->add('date_enregistrement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
