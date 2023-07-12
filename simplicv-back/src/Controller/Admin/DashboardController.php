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
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
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
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        yield MenuItem::section('Utilisateurs', 'fa fa-user');
        
        yield MenuItem::linkToCrud('Voir les utilisateurs', 'fa fa-eye', User::class);
        yield MenuItem::linkToCrud('Ajouter un utilisateur', 'fa fa-plus', User::class)->setAction(Crud::PAGE_NEW);
            
        
        yield MenuItem::section('Modèles de CV', 'fa fa-file');
        
            yield MenuItem::linkToCrud('Voir les modèles', 'fa fa-eye', CVModel::class);
            yield MenuItem::linkToCrud('Ajouter un modèle', 'fa fa-plus', CVModel::class)->setAction(Crud::PAGE_NEW);
            // MenuItem::linkToCrud('Voir les profils', 'fa fa-address-card', Profil::class),
            // MenuItem::linkToCrud('Ajouter un profil', 'fa fa-plus', Profil::class)->setAction(Crud::PAGE_NEW),
            // MenuItem::linkToCrud('Voir les formations', 'fa fa-graduation-cap', Formation::class),
            // MenuItem::linkToCrud('Ajouter une formation', 'fa fa-plus', Formation::class)->setAction(Crud::PAGE_NEW),
            // MenuItem::linkToCrud('Voir les expériences', 'fa fa-briefcase', Experience::class),
            // MenuItem::linkToCrud('Ajouter une expérience', 'fa fa-plus', Experience::class)->setAction(Crud::PAGE_NEW),
            // MenuItem::linkToCrud('Voir les comptétences', 'fa fa-rectangle-list', Skill::class),
            // MenuItem::linkToCrud('Ajouter une comptétence', 'fa fa-plus', Skill::class)->setAction(Crud::PAGE_NEW),
            // MenuItem::linkToCrud('Voir les langues', 'fa fa-language', Language::class),
            // MenuItem::linkToCrud('Ajouter une langue', 'fa fa-plus', Language::class)->setAction(Crud::PAGE_NEW),
            // MenuItem::linkToCrud('Voir les réseaux sociaux', 'fa fa-hashtag', SocialMedias::class),
            // MenuItem::linkToCrud('Ajouter une réseau social', 'fa fa-plus', SocialMedias::class)->setAction(Crud::PAGE_NEW)
        
        yield MenuItem::section('Modèles de Lettres de motivation', 'fa fa-edit');
        
            yield MenuItem::linkToCrud('Voir les lettres', 'fa fa-eye', CoverLetterModel::class);
            yield MenuItem::linkToCrud('Ajouter une lettre', 'fa fa-plus', CoverLetterModel::class)->setAction(Crud::PAGE_NEW);
        
        // yield MenuItem::subMenu('Contenu de lettres de motivation', 'fa fa-edit')->setSubItems( [
        //     MenuItem::linkToCrud('Voir les lettres', 'fa fa-eye', CoverLetter::class),
        //     MenuItem::linkToCrud('Ajouter une lettre de motivation', 'fa fa-plus', CoverLetter::class)->setAction(Crud::PAGE_NEW) ]);
       
        
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets()
            ->addWebpackEncoreEntry('admin');
    }

          
}
