<?php

namespace App\Controller;

use App\Service\FishService;
use PDOException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class DefaultController extends AbstractController
{    
    #[Route('/default', name: 'app_default')]
    public function index(): JsonResponse
    {
      return new JsonResponse([
        'message' => 'Welcome to your new controller!',
        'path' => 'src/Controller/DefaultController.php',
      ]);
    }
}