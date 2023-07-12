<?php

namespace App\Controller\Admin;

use App\Entity\CoverLetter;
use App\Entity\CoverLetterModel;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class CoverLetterModelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CoverLetterModel::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addTab('Contenu');
        yield TextField::new('coverLetter.firstnameSender', 'Prénom')->hideOnIndex()->setRequired(true);
        yield TextField::new('coverLetter.lastnameSender', 'Nom')->hideOnIndex()->setRequired(true);
        yield TextField::new('coverLetter.postalAddressSender', 'Adresse postale')->hideOnIndex()->setRequired(true);
        yield TextField::new('coverLetter.citySender', 'Ville')->hideOnIndex()->setRequired(true);
        yield IntegerField::new('coverLetter.zipCodeSender', 'Code postale')->hideOnIndex()->setRequired(true);
        yield TextField::new('coverLetter.mailAddressSender', 'Adresse e-mail')->hideOnIndex()->setRequired(true);
        yield IntegerField::new('coverLetter.phoneNumberSender', 'Numéro de téléphone')->hideOnIndex()->setRequired(true);
        yield DateField::new('coverLetter.dateOfCreation', 'Date de création')->hideOnIndex()->setRequired(true);
        yield TextField::new('coverLetter.placeOfCreation', 'Lieu de création')->hideOnIndex()->setRequired(true);
        

        yield TextField::new('coverLetter.firstnameReceiver', 'Prénom')->hideOnIndex()->setRequired(true);
        yield TextField::new('coverLetter.lastnameReceiver', 'Nom')->hideOnIndex()->setRequired(true);
        yield TextField::new('coverLetter.postalAddressReceiver', 'Adresse postale')->hideOnIndex()->setRequired(true);
        yield TextField::new('coverLetter.cityReceiver', 'Ville')->hideOnIndex()->setRequired(true);
        yield IntegerField::new('coverLetter.zipCodeReceiver', 'Code postale')->hideOnIndex()->setRequired(true);
        yield TextField::new('coverLetter.object', 'Titre')->hideOnIndex()->setRequired(true);
        yield TextareaField::new('coverLetter.text', 'Description')->hideOnIndex()->setRequired(true);

        yield FormField::addTab('Mise en page');
        yield IdField::new('id')->hideOnForm()->hideOnIndex();
        yield TextField::new('name', 'Nom');
        yield SlugField::new('slug', 'Slug')->setTargetFieldName('name')->hideOnIndex();
        yield TextField::new('titleFont');
        yield TextField::new('textFont');
        yield ColorField::new('bgColor');
        yield ColorField::new('titleColor');
        yield ColorField::new('textColor');
        yield DateTimeField::new('createdAt')->hideOnForm();
        yield DateTimeField::new('updatedAt')->hideOnForm();
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function createEntity(string $entityFqcn)
    {
        $coverLetter = new CoverLetter();
        $coverLetter->setFirstnameSender('prénom');
        $coverLetter->setDateOfCreation(new \DateTimeImmutable('2000-01-01'));
        $coverLetter->setPlaceOfCreation('Ville');
        $coverLetter->setPhoneNumberSender('0628405040');

        $coverLetter->setPostalAddressSender('2 rue machin');
        $coverLetter->setZipCodeSender('33000');
        $coverLetter->setCitySender('Bordeaux');

        $coverLetter->setFirstnameReceiver('prénom');
        $coverLetter->setLastnameReceiver('nom');
        $coverLetter->setNameCompany('Nom de la société');
        $coverLetter->setPostalAddressReceiver('2 rue machin');
        $coverLetter->setZipCodeReceiver('33000');
        $coverLetter->setCityReceiver('Bordeaux');
        
        $coverLetter->setMailAddressSender('nomprenom@gmail.com');
        $coverLetter->setObject('Titre');
        $coverLetter->setText('Description');

        // Créez une instance de CVModel et associez le coverLetter créé
        $entity = new CoverLetterModel();
        $entity->setCoverLetter($coverLetter);

        return $entity;
    }
}
