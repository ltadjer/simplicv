<?php
namespace App\Controller\Api;

use App\Entity\CoverLetterModel;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ApiCoverLetterModelController extends AbstractController
{
    #[Route('/api/modeles-de-lettres', name: 'api_letters', methods: ['GET'])]
    public function getCoverLetters(ManagerRegistry $doctrine, SerializerInterface $serializer): JsonResponse
    {
        $repository = $doctrine->getRepository(CoverLetterModel::class);
        $coverLetterModels = $repository->findAll();

        $context = [
            AbstractNormalizer::IGNORED_ATTRIBUTES => ['coverLetterModels']
        ];

        $lettersJson = $serializer->serialize($coverLetterModels, 'json', $context);

        $coverLetter = json_decode($lettersJson, true);

        return $this->json($coverLetter);
    }

    #[Route('/api/modeles-de-lettres/{slug}', name: 'api_letter', methods: ['GET'])]
    public function getLetter(string $slug, ManagerRegistry $doctrine, SerializerInterface $serializer): JsonResponse
    {
        $repository = $doctrine->getRepository(CoverLetterModel::class);
        $modelLetter = $repository->findOneBy(['slug'=>$slug]);
        $context = [
            AbstractNormalizer::IGNORED_ATTRIBUTES => ['coverLetterModels']
        ];

        $letterJson = $serializer->serialize($modelLetter, 'json', $context);

        $letter = json_decode($letterJson, true);

        return $this->json($letter);
    }
}
