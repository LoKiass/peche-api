<?php
namespace App\Model;

class Fish {
    private int $id;
    private string $name;
    private string $species;

    public function __construct(int $id, string $name, string $species) {
        $this->id = $id;
        $this->name = $name;
        $this->species = $species;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSpecies(): string {
        return $this->species;
    }

}