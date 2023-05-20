<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/articles', name: 'api_articles', methods: ['GET'])]
    public function getArticles(ManagerRegistry $doctrine): JsonResponse
    {
        
        $repository = $doctrine->getRepository(Article::class);
        $articles = $repository->findAll();

        return $this->json($articles);
    }
}