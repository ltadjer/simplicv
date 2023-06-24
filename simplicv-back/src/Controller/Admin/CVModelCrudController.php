<?php

namespace App\Controller\Admin;

use App\Entity\CVModel;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
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
        return [
            IdField::new('id')->hideOnForm()->hideOnIndex(),
            AssociationField::new('profil', 'Profils'),
            AssociationField::new('formations', 'Formations'),
            AssociationField::new('experiences', 'Expériences'),
            AssociationField::new('skills', 'Compétences'),
            AssociationField::new('languages', 'Languages'),
            AssociationField::new('socialMedias', 'Les réseaux sociaux'),
            TextField::new('name', 'Nom'),
            SlugField::new('slug', 'Slug')->setTargetFieldName('name')->hideOnIndex(),
            TextField::new('type', 'Type de modèle'),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
            ColorField::new('bgColor'),
            // ColorField::new('titleColor'),
            ColorField::new('textColor'),
            //idéalement un select avec des polices prédéfinis (à voir après)
            TextField::new('titleFont'),
            TextField::new('textFont'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
    ;
    }
}
