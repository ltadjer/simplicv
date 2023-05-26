<?php

namespace App\Controller\Admin;

use App\Entity\CoverLetter;
use App\Entity\CoverLetterModel;
use App\Entity\CVModel;
use App\Entity\User;
use App\Entity\Profil;
use App\Entity\Formation;
use App\Entity\Experience;
use App\Entity\Skill;
use App\Entity\Language;
use App\Entity\SocialMedias;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administrateur');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Utilisateurs', 'fa fa-user');
        yield MenuItem::subMenu('Actions', 'fa fa-bars')->setSubItems( [
            MenuItem::linkToCrud('Voir les utilisateurs', 'fa fa-eye', User::class),
            MenuItem::linkToCrud('Ajouter un utilisateur', 'fa fa-plus', User::class)->setAction(Crud::PAGE_NEW)
            
        ]);
        yield MenuItem::section('Modèles de CV', 'fa fa-file');
        yield MenuItem::subMenu('Actions', 'fa fa-bars')->setSubItems( [
            MenuItem::linkToCrud('Voir les modèles', 'fa fa-eye', CVModel::class),
            MenuItem::linkToCrud('Ajouter un modèle', 'fa fa-plus', CVModel::class)->setAction(Crud::PAGE_NEW)
        ]); 
        yield MenuItem::subMenu('Bloc profil', 'fa fa-address-card')->setSubItems( [
            MenuItem::linkToCrud('Voir les profils', 'fa fa-eye', Profil::class),
            MenuItem::linkToCrud('Ajouter un profil', 'fa fa-plus', Profil::class)->setAction(Crud::PAGE_NEW),
        ]); 
        yield MenuItem::subMenu('Bloc formations', 'fa fa-graduation-cap')->setSubItems( [
            MenuItem::linkToCrud('Voir les formations', 'fa fa-eye', Formation::class),
            MenuItem::linkToCrud('Ajouter une formation', 'fa fa-plus', Formation::class)->setAction(Crud::PAGE_NEW)
        ]); 
        yield MenuItem::subMenu('Bloc expériences', 'fa fa-briefcase')->setSubItems( [
            MenuItem::linkToCrud('Voir les expériences', 'fa fa-eye', Experience::class),
            MenuItem::linkToCrud('Ajouter une expérience', 'fa fa-plus', Experience::class)->setAction(Crud::PAGE_NEW)
        ]); 
        yield MenuItem::subMenu('Bloc comptétences', 'fa fa-rectangle-list')->setSubItems( [
            MenuItem::linkToCrud('Voir les comptétences', 'fa fa-eye', Skill::class),
            MenuItem::linkToCrud('Ajouter une comptétence', 'fa fa-plus', Skill::class)->setAction(Crud::PAGE_NEW)
        ]); 
        yield MenuItem::subMenu('Bloc langues', 'fa fa-language')->setSubItems( [
            MenuItem::linkToCrud('Voir les langues', 'fa fa-eye', Language::class),
            MenuItem::linkToCrud('Ajouter une langue', 'fa fa-plus', Language::class)->setAction(Crud::PAGE_NEW)
        ]); 
        yield MenuItem::subMenu('Bloc réseaux sociaux', 'fa fa-hashtag')->setSubItems( [
            MenuItem::linkToCrud('Voir les réseaux sociaux', 'fa fa-eye', SocialMedias::class),
            MenuItem::linkToCrud('Ajouter une réseau social', 'fa fa-plus', SocialMedias::class)->setAction(Crud::PAGE_NEW)
        ]); 

        yield MenuItem::section('Modèles de Lettres de motivation', 'fa fa-file');
        yield MenuItem::subMenu('Actions', 'fa fa-bars')->setSubItems( [
            MenuItem::linkToCrud('Voir les lettres', 'fa fa-eye', CoverLetterModel::class),
            MenuItem::linkToCrud('Ajouter une lettre de motivation', 'fa fa-plus', CoverLetterModel::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::subMenu('Contenu de lettres de motivation', 'fa fa-edit')->setSubItems( [
            MenuItem::linkToCrud('Voir les lettres', 'fa fa-eye', CoverLetter::class),
            MenuItem::linkToCrud('Ajouter une lettre de motivation', 'fa fa-plus', CoverLetter::class)->setAction(Crud::PAGE_NEW)
        ]); 

    }
                
}
