<?php
namespace App\Controller\Api;

use App\Entity\CoverLetter;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiCoverLetterModelController extends AbstractController
{
    #[Route('/api/lettres-de-motivations', name: 'api_letters', methods: ['GET'])]
    public function getCoverLetters(ManagerRegistry $doctrine): JsonResponse
    {
        $repository = $doctrine->getRepository(CoverLetter::class);
        $coverLetterModels = $repository->findAll();
        return $this->json($coverLetterModels);
    }
}
