<?php
// 請求書を表すクラス
namespace App\Models;// 名前空間

//FoodOrderを使うのでuseする
use App\Models\FoodOrder;

class Invoice{
    private float $finalPrice;
    private \DateTimeImmutable $orderTime;
    private $estimatedTimeInMinutes;

    public function __construct(FoodOrder $foodOrder, int $estimatedTimeInMinutes){
    // FoodOrderから合計金額と注文時刻を取得
        $this->finalPrice = $foodOrder->calculateTotal();
        $this->orderTime = $foodOrder->getOrderTime();
        $this->estimatedTimeInMinutes = $estimatedTimeInMinutes;
    }
    public function getFinalPrice(): float { return $this->finalPrice; }
    public function getOrderTime(): \DateTimeImmutable { return $this->orderTime; }
    public function getEstimatedTimeInMinutes(): int { return $this->estimatedTimeInMinutes; }

}