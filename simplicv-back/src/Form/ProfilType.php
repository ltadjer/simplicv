<?php

namespace App\Form;

use App\Entity\Profil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstname', TextType::class, [
            'label' => 'Prénom',
        ])
        ->add('lastname', TextType::class, [
            'label' => 'Nom',
        ])
        ->add('dateOfBirth', DateType::class, [
            'label' => 'Date de naissance',
            'widget' => 'single_text',
            'attr' => ['class' => 'datepicker'],
        ])
        ->add('phoneNumber', IntegerType::class, [
            'label' => 'Numéro de téléphone',
        ])
        ->add('postalAddress', TextType::class, [
            'label' => 'Adresse postale',
        ])
        ->add('zipCode', IntegerType::class, [
            'label' => 'Code postal',
        ])
        ->add('mailAddress', EmailType::class, [
            'label' => 'Adresse e-mail',
        ])
        ->add('title', TextType::class, [
            'label' => 'Titre',
        ])
        ->add('description', TextareaType::class, [
            'label' => 'Description',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profil::class,
        ]);
    }
}
