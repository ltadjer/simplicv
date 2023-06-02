<?php
namespace App\Controller\Api;

use App\Entity\CoverLetterModel;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiCoverLetterModelController extends AbstractController
{
    #[Route('/api/lettres-de-motivations', name: 'api_letters', methods: ['GET'])]
    public function getCoverLetters(ManagerRegistry $doctrine): JsonResponse
    {
        $repository = $doctrine->getRepository(CoverLetterModel::class);
        $coverLetterModels = $repository->findAll();

        $coverLetters = [];

        // Parcourir chaque modèle de lettre de motivation
        foreach ($coverLetterModels as $coverLetterModel) {
            // Parcourir chaque lettre de motivation associée au modèle
            foreach ($coverLetterModel->getCoverLetters() as $coverLetter) {
                // Créer un tableau associatif avec les propriétés du modèle de lettre de motivation et le texte brut
                $letterData = [
                    'coverLetterModel' => $coverLetterModel,
                    'text' => $coverLetter->getText(),
                ];

                // Ajouter la lettre de motivation au tableau
                $coverLetters[] = $letterData;
            }
        }

        return $this->json($coverLetters);
    }
}
