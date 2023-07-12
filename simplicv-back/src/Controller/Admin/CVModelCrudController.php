<?php

namespace App\Controller\Admin;

use App\Entity\CVModel;
use App\Entity\Formation;
use App\Entity\Profil;
use App\Form\ExperienceType;
use App\Form\FormationType;
use App\Form\LanguageType;
use App\Form\ProfilType;
use App\Form\SkillType;
use App\Form\SocialMediaType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
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

        yield FormField::addTab('Profil');
        yield TextField::new('profil.firstname', 'Prénom')->hideOnIndex()->setRequired(true);
        yield TextField::new('profil.lastname', 'Nom')->hideOnIndex()->setRequired(true);
        yield DateField::new('profil.dateOfBirth', 'Date de naissance')->hideOnIndex()->setRequired(true);
        yield IntegerField::new('profil.phoneNumber', 'Numéro de téléphone')->hideOnIndex()->setRequired(true);
        yield TextField::new('profil.postalAddress', 'Adresse postale')->hideOnIndex()->setRequired(true);
        yield IntegerField::new('profil.zipCode', 'Code postale')->hideOnIndex()->setRequired(true);
        yield TextField::new('profil.mailAddress', 'Adresse e-mail')->hideOnIndex()->setRequired(true);
        yield TextField::new('profil.title', 'Titre')->hideOnIndex()->setRequired(true);
        yield TextareaField::new('profil.description', 'Description')->hideOnIndex()->setRequired(true);


        yield FormField::addTab('Formations');
        yield CollectionField::new('formations', 'Formation')
            ->setEntryType(FormationType::class)
            ->setFormTypeOptions([
                'entry_type' => FormationType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ]);
        yield FormField::addTab('Expériences');
        yield CollectionField::new('experiences', 'Experience')
            ->setEntryType(ExperienceType::class)
            ->setFormTypeOptions([
                'entry_type' => ExperienceType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ]);
        yield FormField::addTab('Compétences');
        yield CollectionField::new('skills', 'Skill')
            ->setEntryType(SkillType::class)
            ->setFormTypeOptions([
                'entry_type' => SkillType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ]);
        yield FormField::addTab('Langues');
        yield CollectionField::new('languages', 'Language')
            ->setEntryType(LanguageType::class)
            ->setFormTypeOptions([
                'entry_type' => LanguageType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ]);
        yield FormField::addTab('Réseaux sociaux');
        yield CollectionField::new('socialMedias', 'socialMedias')
            ->setEntryType(SocialMediaType::class)
            ->setFormTypeOptions([
                'entry_type' => SocialMediaType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ]);

        yield FormField::addTab('Mise en page');
        yield TextField::new('name', 'Nom');
        yield SlugField::new('slug', 'Slug')->setTargetFieldName('name')->hideOnIndex();
        yield TextField::new('type', 'Type de modèle');
        yield DateTimeField::new('createdAt')->hideOnForm();
        yield DateTimeField::new('updatedAt')->hideOnForm();
        yield ColorField::new('bgColor');
        yield ColorField::new('textColor');
        yield TextField::new('titleFont');
        yield TextField::new('textFont');
    }

    public function configureActions(Actions $actions): Actions
    {
        $viewAction = Action::new('Visualiser')
            ->linkToUrl(function (CVModel $CVModel) {
                // Remplacez l'URL par celle de votre front-end
                return '/modeles-de-cv/' . $CVModel->getSlug();
            })
            ->setIcon('fa fa-eye') // Remplacez par l'icône souhaitée
            ->setLabel('View') // Remplacez par le libellé souhaité
            ->setCssClass('btn btn-secondary'); // Ajoutez des classes CSS si nécessaire
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_NEW, Action::NEW)
            ->add(Crud::PAGE_DETAIL, $viewAction)
            ->add(Crud::PAGE_INDEX, $viewAction);
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
        $profil->setDateOfBirth(new \DateTimeImmutable('2000-01-01'));
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
