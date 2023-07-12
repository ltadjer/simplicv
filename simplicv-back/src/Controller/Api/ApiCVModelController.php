<?php
namespace App\Controller\Api;

use App\Entity\CVModel;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ApiCVModelController extends AbstractController
{
    #[Route('/api/modeles-de-cv', name: 'api_all_cv', methods: ['GET'])]
    public function getAllCV(ManagerRegistry $doctrine, SerializerInterface $serializer): JsonResponse
    {
        $repository = $doctrine->getRepository(CVModel::class);
        $modelsCV = $repository->findAll();
        $context = [
            AbstractNormalizer::IGNORED_ATTRIBUTES => ['cVModels']
        ];

        $cvJson = $serializer->serialize($modelsCV, 'json', $context);

        $cv = json_decode($cvJson, true);

        return $this->json($cv);
    }

    #[Route('/api/modeles-de-cv/{slug}', name: 'api_cv', methods: ['GET'])]
    public function getCV(string $slug, ManagerRegistry $doctrine, SerializerInterface $serializer): JsonResponse
    {
        $repository = $doctrine->getRepository(CVModel::class);
        $modelCV = $repository->findOneBy(['slug'=>$slug]);
        $context = [
            AbstractNormalizer::IGNORED_ATTRIBUTES => ['cVModels']
        ];

        $cvJson = $serializer->serialize($modelCV, 'json', $context);

        $cv = json_decode($cvJson, true);

        return $this->json($cv);
    }
}
