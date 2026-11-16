<?php

namespace App\Controller;

use App\Service\Database;
use PDOException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class DefaultController extends AbstractController
{
    #[Route('/default', name: 'app_default')]
    public function index(): JsonResponse
    {
        try {
            $db = new Database();
            $result = $db->getConnection()->query('SELECT * FROM fish')->fetch();

            return $this->json([
                'connected' => true,
                'result' => $result,
            ]);
        } catch (PDOException $e) {
            return $this->json([
                'connected' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}