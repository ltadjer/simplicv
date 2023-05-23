<?php

namespace App\Controller\Admin;

use App\Entity\CVModel;
use App\Entity\User;
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
            ->setTitle('Administrateur Simplicv');
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
    }
                
}
