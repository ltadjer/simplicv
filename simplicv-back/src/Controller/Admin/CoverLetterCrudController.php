<?php

namespace App\Controller\Admin;

use App\Entity\CoverLetter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CoverLetterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CoverLetter::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnIndex(),
            TextField::new('firstnameSender'),
            TextField::new('lastnameSender'),
            EmailField::new('mailAddressSender'),
            NumberField::new('phoneNumberSender'),
            TextField::new('postalAddressReceiver'),
            IntegerField::new('zipCodeReceiver'),
            TextField::new('cityReceiver'),
            DateField::new('dateOfCreation'),
            TextField::new('placeOfCreation'),
            TextField::new('object'),
            TextEditorField::new('text', 'Texte'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
    ;
    }
}
