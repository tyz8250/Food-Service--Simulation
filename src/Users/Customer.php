<?php
namespace App\Users; // 名前空間は App\Users 

// 継承する AbstractPerson と、使う Restaurant、Invoice を use する
use App\Models\AbstractPerson;
use App\Models\Restaurant;
use App\Models\Invoice;

class Customer extends AbstractPerson { // AbstractPerson を継承！
    // Customer 固有のプロパティやメソッドがあればここに追加
    // クラス図には +interestedCategories があるが、ここでは一旦省略。
    // order メソッドはクラス図にある通り実装。

    /**
     * @param Restaurant $restaurant 注文するレストラン
     * @param string[] $categories 注文するカテゴリのリスト (例: ['Pizza', 'Pasta'])
     * @return Invoice 生成された請求書
     */
    public function order(Restaurant $restaurant, array $categories): Invoice {
        echo $this->getName() . "がレストランに注文します: " . implode(', ', $categories) . PHP_EOL;
        // レストランの order メソッドを呼び出す
        return $restaurant->order($categories);
    }
}