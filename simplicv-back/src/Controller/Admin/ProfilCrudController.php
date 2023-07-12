<?php

namespace App\Controller\Admin;

use App\Entity\Profil;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProfilCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Profil::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnIndex(),
            TextField::new('title', 'Titre'),
            TextField::new('description', 'Description'),
            ImageField::new('image')->setBasePath('/images/profils')->onlyOnIndex(),
            Field::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms(),
            DateTimeField::new('updatedAt')->onlyOnDetail(),
            Field::new('firstname', 'Prénom'),
            TextField::new('lastname', 'Nom de famille'),
            EmailField::new('mailAddress', 'Adresse e-mail'),
            NumberField::new('phoneNumber', 'Numéro de téléphone'),
            DateField::new('dateOfBirth', 'Date de naissance'),
            TextField::new('postalAddress', 'Adresse postale'),
            NumberField::new('zipCode', 'Code postal'),
            TextField::new('city', 'Ville'),
            TextField::new('drivingLicence', 'Permis de conduire'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->overrideTemplate('crud/new', 'admin/crud/new.html.twig');
    }
}
