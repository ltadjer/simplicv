<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jobTitle', TextType::class, [
                    'label' => 'Intitulé du poste',
                ])
            ->add('contractType', ChoiceType::class, [
                'label' => 'Type de contrat',
                'choices'=>[
                    'CDI' =>'CDI', 
                    'CDD'=>'CDD', 
                    'Alternance'=>'Alternance', 
                    'Stage'=>'Stage'
                ]
            ])
            ->add('employer', TextType::class, [
                    'label' => 'Nom de l\'entreprise',
                ])
            ->add('city', TextType::class, [
                    'label' => 'Ville',
                ])
            ->add('startDate', DateType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker'],
            ])
            ->add('endDate', DateType::class, [
                'label' => 'Date de fin',
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
