<?php

namespace App\Controller\Admin;

use App\Entity\CVModel;

use App\Entity\Profil;
use App\Form\ExperienceType;
use App\Form\FormationType;
use App\Form\LanguageType;
use App\Form\SkillType;
use App\Form\SocialMediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CVModelCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return CVModel::class;
    }

    public function configureFields(string $pageName): iterable
    {

        yield FormField::addTab('Contenu');
        yield FormField::addPanel('Profil')->hideOnIndex();
        yield ImageField::new('profil.image')
        ->setBasePath('/images/profils')
        ->setLabel('Image du profil')
        ->onlyOnForms()
        ->setUploadDir('public/images/profils') 
        ->setUploadedFileNamePattern('[name].[extension]'); 
        yield DateTimeField::new('profil.updatedAt')
            ->setLabel('Dernière mise à jour')
            ->onlyOnDetail();
        yield TextField::new('profil.firstname', 'Prénom')->hideOnIndex()->setRequired(true);
        yield TextField::new('profil.lastname', 'Nom')->hideOnIndex()->setRequired(true);
        yield DateField::new('profil.dateOfBirth', 'Date de naissance')->hideOnIndex()->setRequired(true);
        yield TextField::new('profil.mailAddress', 'Adresse e-mail')->hideOnIndex()->setRequired(true);
        yield IntegerField::new('profil.phoneNumber', 'Numéro de téléphone')->hideOnIndex()->setRequired(true);
        yield TextField::new('profil.postalAddress', 'Adresse postale')->hideOnIndex()->setRequired(true);
        yield TextField::new('profil.city', 'Ville')->hideOnIndex()->setRequired(true);
        yield IntegerField::new('profil.zipCode', 'Code postal')->hideOnIndex()->setRequired(true);
        yield TextField::new('profil.drivingLicence', 'Type de permis')->hideOnIndex()->setRequired(true);
        yield TextField::new('profil.title', 'Titre')->hideOnIndex()->setRequired(true);
        yield TextareaField::new('profil.description', 'Description')->hideOnIndex()->setRequired(true);


        yield FormField::addPanel('Formations');
        yield CollectionField::new('formations', 'Formations')
            ->setEntryType(FormationType::class)
            ->setFormTypeOptions([
                'entry_type' => FormationType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->hideOnIndex();
        yield FormField::addPanel('Expériences');
        yield CollectionField::new('experiences', 'Expériences')
            ->setEntryType(ExperienceType::class)
            ->setFormTypeOptions([
                'entry_type' => ExperienceType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->hideOnIndex();
        yield FormField::addPanel('Compétences');
        yield CollectionField::new('skills', 'Compétences')
            ->setEntryType(SkillType::class)
            ->setFormTypeOptions([
                'entry_type' => SkillType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->hideOnIndex();
        yield FormField::addPanel('Langues');
        yield CollectionField::new('languages', 'Langues')
            ->setEntryType(LanguageType::class)
            ->setFormTypeOptions([
                'entry_type' => LanguageType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->hideOnIndex();
        yield FormField::addPanel('Réseaux sociaux');
        yield CollectionField::new('socialMedias', 'Réseaux sociaux')
            ->setEntryType(SocialMediaType::class)
            ->setFormTypeOptions([
                'entry_type' => SocialMediaType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->hideOnIndex();

        yield FormField::addTab('Mise en page');
        yield TextField::new('name', 'Nom');
        yield SlugField::new('slug', 'Slug')->setTargetFieldName('name')->hideOnIndex();
        yield TextField::new('type', 'Type de modèle')->hideOnIndex();
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
            ->setEmptyData('Arial');
        yield ChoiceField::new('textFont')
            ->setLabel('Police du texte')
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
        yield DateTimeField::new('createdAt', 'Date de création')->hideOnForm();
        yield DateTimeField::new('updatedAt', 'Date de modification')->hideOnForm();
        yield ColorField::new('bgColor', 'Couleur de fond');
        yield ColorField::new('titleColor', 'Couleur de titre');
        yield ColorField::new('textColor', 'Couleur du texte');
    }

    public function configureActions(Actions $actions): Actions
    {
        $viewAction = Action::new('Visualiser')
            ->linkToUrl(function (CVModel $CVModel) {
                return '/modeles-de-cv/' . $CVModel->getSlug();
            })
            ->setLabel('Visualiser') 
            ->setCssClass('btn btn-secondary'); 
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_NEW, Action::NEW)
            ->add(Crud::PAGE_DETAIL, $viewAction)
            ->add(Crud::PAGE_EDIT, $viewAction);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle(Crud::PAGE_INDEX, 'Modèles de CV')
            ->setPageTitle(Crud::PAGE_NEW, 'Créer un modèle de CV')
            ->setPageTitle(Crud::PAGE_DETAIL, static function (CVModel $CVModel) {
                return sprintf('#%s %s', $CVModel->getId(), $CVModel->getName());
            })
            ->setPageTitle(Crud::PAGE_EDIT, static function (CVModel $CVModel) {
                return sprintf('#%s %s', $CVModel->getId(), $CVModel->getName());
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
        // Créez une instance de Profil et définissez ses propriétés
        $profil = new Profil();
        $profil->setFirstname('prénom');
        $profil->setDateOfBirth(new \DateTime('2000-01-01'));
        $profil->setPhoneNumber('0628405040');
        $profil->setPostalAddress('2 rue machin');
        $profil->setZipCode('33000');
        $profil->setCity('Bordeaux');
        $profil->setMailAddress('nomprenom@gmail.com');
        $profil->setTitle('Titre');
        $profil->setDescription('Description');
        // Créez une instance de CVModel et associez le profil créé
        $entity = new CVModel();
        $entity->setProfil($profil);

        return $entity;
    }
}
