<?php
namespace App\Model;

class Fish {
    private int $id;
    private string $name;
    private int $taille;

    public function __construct(int $id, string $name, int $taille) {
        $this->id = $id;
        $this->name = $name;
        $this->taille = $taille;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getTaille(): string {
        return $this->taille;
    }

}