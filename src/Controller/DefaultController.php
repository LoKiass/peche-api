<?php

namespace App\Controller;

use App\Service\FishService;
use PDOException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class DefaultController extends AbstractController
{

    public function __construct(private FishService $fishService) {}
    

    #[Route('/default', name: 'app_default')]
    public function index(): JsonResponse
    {
        try {
            $id = 1; // Example fish ID
            $fish = $this->fishService->getFishById($id);

            if ($fish) {
                return new JsonResponse([
                    'id' => $fish->getId(),
                    'name' => $fish->getName(),
                    'species' => $fish->getSpecies(),
                ]);
            }
            else {
                return new JsonResponse(['error' => 'Fish not found'], 404);
            }
        } catch (PDOException $e) {
            return new JsonResponse(['error' => 'Database connection failed: ' . $e->getMessage()], 500);
        }
    }
}