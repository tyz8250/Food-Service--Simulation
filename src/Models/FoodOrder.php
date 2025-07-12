<?php
namespace App\Models; // 名前空間は App\Models に！

// FoodItem を使うので use する
use App\Models\FoodItem;

class FoodOrder {
    /** @var FoodItem[] $items // 注釈：この配列は FoodItem のインスタンスのみを含む */
    private array $items;
    private \DateTimeImmutable $orderTime; // 注文時刻。変更不可な DateTimeImmutable を推奨

    public function __construct(array $items) {
        // 注文時に FoodItem の配列を受け取る
        $this->items = $items;
        $this->orderTime = new \DateTimeImmutable(); // 現在時刻を設定
    }

    public function getItems(): array { return $this->items; }
    public function getOrderTime(): \DateTimeImmutable { return $this->orderTime; }

    public function calculateTotal(): float {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item->getPrice(); // 各アイテムの価格を合計
        }
        return $total;
    }
}
