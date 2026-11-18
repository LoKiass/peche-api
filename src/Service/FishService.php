<?php
namespace App\Service;

use PDOException;
use App\Model\Fish;
use App\Service\Database;

class FishService {
    

    public function __construct(private Database $database) {}

    // Permet de recuper un poissons via un ID
    public function getFishById(int $id): ?Fish {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM fish WHERE id_fish = ?");
        $stmt->execute([$id]);

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row) {
            return new Fish($row['id_fish'], $row['nom'], $row['taille']);
        }
        return null;
    }

    // Permet de recuperer touts les poissons de la DB
    public function getAllFish(){
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM fish");
        $stmt->execute();

        
        $list_fish = $stmt->fetchAll();

        if ($list_fish) {
            return $list_fish;
        }
        else{
            throw new PDOException("Erreur");
        }
    
    }

    // Permet la créations d'un poissons 
    public function createFish(Fish $fish) : bool{
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("INSERT INTO fish (nom, taille) VALUES (?, ?)");
        $result = $stmt->execute([$fish->getName(), $fish->getTaille()]);

        if ($result) {
            return true;
        }
        else return false;
    }

    public function deleteFish(int $id) : bool {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->prepare("DELETE FROM fish where id_fish = ?");
        $result = $stmt->execute([$id]);

        if ($result){
            return true;
        } else {
            return false;
        }
    }
}