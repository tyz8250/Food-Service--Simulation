<?php

namespace App\ConcreteFoods;// 名前空間はApp\ConcreteFoodsに定義
use App\Models\FoodItem;//  FoodItem は App\Models にあるので use する

class HawaiianPizza extends FoodItem{
    public function __construct(float $price){
        parent::__construct("Hawaiian Pizza", "パイナップルとハムのピザ", $price);
    }

    public static function getCategory(): string{
        return "pizza";
    }
}