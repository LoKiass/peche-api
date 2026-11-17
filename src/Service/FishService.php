<?php
namespace App\Service;

use App\Model\Fish;
use App\Service\Database;

class FishService {
    

    public function __construct(private Database $database) {}

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
}