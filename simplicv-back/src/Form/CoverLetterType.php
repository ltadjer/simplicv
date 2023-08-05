<?php

namespace App\Form;

use App\Entity\CoverLetter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CoverLetterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstnameSender', TextType::class, [
            'label' => 'Prénom',
        ])
        ->add('lastnameSender', TextType::class, [
            'label' => 'Nom',
        ])
        ->add('mailAddressSender', EmailType::class, [
            'label' => 'Adresse e-mail',
        ])
        ->add('phoneNumberSender', IntegerType::class, [
            'label' => 'Numéro de téléphone',
        ])
        ->add('postalAddressSender', TextType::class, [
            'label' => 'Adresse postale',
        ])
        ->add('citySender', TextType::class, [
            'label' => 'Ville',
        ])
        ->add('zipCodeSender', IntegerType::class, [
            'label' => 'Code postal',
        ])
        ->add('firstnameReceiver', TextType::class, [
            'label' => 'Prénom',
        ])
        ->add('lastnameReceiver', TextType::class, [
            'label' => 'Nom',
        ])
        ->add('postalAddressReceiver', TextType::class, [
            'label' => 'Adresse postale',
        ])
        ->add('cityReceiver', TextType::class, [
            'label' => 'Ville',
        ])
        ->add('zipCodeReceiver', IntegerType::class, [
            'label' => 'Code postal',
        ])
        ->add('object', TextType::class, [
            'label' => 'Objet',
        ])
        ->add('text', TextareaType::class, [
            'label' => 'Description',
        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CoverLetter::class,
        ]);
    }
}
