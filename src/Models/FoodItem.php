<?php
namespace App\Models;

abstract class FoodItem{
    protected string $name;
    protected string $description;
    protected float $price;


    public function __construct(string $name, string $description, float $price) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }
    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getPrice(): float { return $this->price; }

    // クラス図にある静的メソッド。各具象クラスで実装を強制
    abstract public static function getCategory(): string;
}

