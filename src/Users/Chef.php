<?php
namespace App\Users; // 名前空間は App\Users 

use App\Models\FoodOrder;    // prepareFood メソッドで FoodOrder を使うので use する
use App\Users\Employee;      // Employee を継承するので use する

class Chef extends Employee {
    /**
     * Chef クラスのコンストラクタ
     * 親クラス（Employee）のプロパティに加え、Chef 固有の初期化があればここで行う。
     *
     * @param string $name     名前
     * @param int    $age      年齢
     * @param string $address  住所
     * @param int    $employeeId 従業員ID
     * @param float  $salary   給与
     */
    public function __construct(string $name, int $age, string $address, int $employeeId, float $salary) {
        // 親クラス（Employee）のコンストラクタを呼び出し、共通のプロパティを初期化
        parent::__construct($name, $age, $address, $employeeId, $salary);
    }

    /**
     * 料理を準備します。
     * FoodOrder を受け取ります。
     *
     * @param FoodOrder $foodOrder 準備する料理の注文
     * @return string 料理準備のステータスメッセージ
     */
    public function prepareFood(FoodOrder $foodOrder): string {
        $items = [];
        foreach ($foodOrder->getItems() as $item) {
            $items[] = $item->getName();
        }
        $itemList = implode(', ', $items);

        return $this->getName() . "が注文 (" . $itemList . ") の調理を開始しました。";
    }

}