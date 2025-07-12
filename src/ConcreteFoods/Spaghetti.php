<?php
namespace App\ConcreteFoods; // 名前空間は App\ConcreteFoods に！

use App\Models\FoodItem; // FoodItem は App\Models にあるので use する

class Spaghetti extends FoodItem {
    public function __construct(float $price) {
        parent::__construct("Spaghetti Bolognese", "ミートソーススパゲッティ", $price);
    }

    public static function getCategory(): string {
        return "Pasta"; // この食べ物のカテゴリ
    }
}
