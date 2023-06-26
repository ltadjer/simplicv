<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class CVModelMenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('menu', ChoiceType::class, [
                'choices' => [
                    'Général' => 'general',
                    'Profil' => 'profil',
                    'Formations' => 'formations',
                    'Expériences' => 'experiences',
                    'Compétences' => 'skills',
                ],
                'expanded' => true,
                'multiple' => false,
            ]);
    }
}
