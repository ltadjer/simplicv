<?php

namespace App\Controller\Admin;

use App\Entity\{CoverLetter,CoverLetterModel};
use EasyCorp\Bundle\EasyAdminBundle\Config\{Action,Actions,Crud};
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{ChoiceField, ColorField,DateTimeField,FormField,IdField,SlugField,TextField,DateField,IntegerField,TextareaField };

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
        yield ChoiceField::new('titleFont')
        ->setLabel('Police des titres')
        ->setChoices([
            'Arial' => 'Arial',
            'Times New Roman' => 'Times New Roman',
            'Calibri' => 'Calibri',
            'Helvetica' => 'Helvetica',
            'Garamond' => 'Garamond',
            'Verdana' => 'Verdana',
            'Cambria' => 'Cambria',
            'Tahoma' => 'Tahoma',
            'Georgia' => 'Georgia',
            'Century Gothic' => 'Century Gothic',
        ])
        ->setValue('Arial');
        yield ChoiceField::new('textFont')
        ->setLabel('Police des textes')
        ->setChoices([
            'Arial' => 'Arial',
            'Times New Roman' => 'Times New Roman',
            'Calibri' => 'Calibri',
            'Helvetica' => 'Helvetica',
            'Garamond' => 'Garamond',
            'Verdana' => 'Verdana',
            'Cambria' => 'Cambria',
            'Tahoma' => 'Tahoma',
            'Georgia' => 'Georgia',
            'Century Gothic' => 'Century Gothic',
        ])
        ->setValue('Arial');
        yield ColorField::new('bgColor');
        yield ColorField::new('titleColor');
        yield ColorField::new('textColor');
        yield DateTimeField::new('createdAt')->hideOnForm();
        yield DateTimeField::new('updatedAt')->hideOnForm();
    }

    public function configureActions(Actions $actions): Actions
    {
        $viewAction = Action::new('Visualiser')
        ->linkToUrl(function (CoverLetterModel $CoverLetterModel) {
            
            return '/modeles-de-lettres/' . $CoverLetterModel->getSlug();
        })
        ->setIcon('fa fa-eye') 
        ->setLabel('Visualiser')
        ->setCssClass('btn btn-secondary');
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_DETAIL, $viewAction)
            ->add(Crud::PAGE_INDEX, $viewAction);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle(Crud::PAGE_INDEX, 'Modèles de lettres de motivation')
            ->setPageTitle(Crud::PAGE_NEW, 'Créer un modèle de lettre de motivation')
            ->setPageTitle(Crud::PAGE_DETAIL, static function (CoverLetterModel $CoverLetterModel) {
                return sprintf('#%s %s', $CoverLetterModel->getId(), $CoverLetterModel->getName());
            })
            ->setPageTitle(Crud::PAGE_EDIT, static function (CoverLetterModel $CoverLetterModel) {
                return sprintf('#%s %s', $CoverLetterModel->getId(), $CoverLetterModel->getName());
            })
            ->setDefaultSort([
                'createdAt' => 'DESC',
            ])
            ->setFormThemes([
                '@EasyAdmin/crud/form_theme.html.twig',
            ]);
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
