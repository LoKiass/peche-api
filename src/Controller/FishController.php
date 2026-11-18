<?php

namespace App\Controller;

use App\Model\Fish;
use \App\Service\FishService;
use PDOException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class FishController extends AbstractController
{

    public function __construct(private FishService $FishService){}

    #[Route('/fish', name: 'app_fish')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/FishController.php',
        ]);
    }

    // Listing de tous les poissons 
    #[Route('/fish/list', name: 'app_fish_list', methods: ['GET'])]
    public function listFish() : JsonResponse
    {
        try{
            $fish_list = $this->FishService->getAllFish();
            if ($fish_list){
                return new JsonResponse([
                    "message" => $fish_list
                ]);
            } else {
                return new JsonResponse([
                    "error" => "",
                    "message" => ""
                ]);
            }
        }catch(PDOException $e) {
            return new JsonResponse([
                "error" => "Database connection error",
                "message" => $e
            ]);
        }
    }

    // Creations d'un poissons 
    #[Route('/fish/create', name: 'api-fish-create', methods: ['POST'])]
    public function createFish(Request $request): JsonResponse{
        try{
            $data = $request->toArray();
            $name = $data["name"];
            $size = $data["size"];

            $fish_to_create = new Fish(0, $name, $size);

            $result = $this->FishService->createFish($fish_to_create);

            if ($result){
                return new JsonResponse([
                    "message" => "Poissons crée avec succès"
                ]);
            }
            else {
                return new JsonResponse([
                    "message" => "Le poissons n'a pas été crée"
                ]);
            }


        } catch(PDOException $e){
            return new JsonResponse([
                "error" => "Database connection failed ",
                "message" => $e
            ]);
        }
    }

}
