<?php
namespace App\Models;

// 使うクラスを use する
use App\ConcreteFoods\HawaiianPizza;
use App\ConcreteFoods\Spaghetti;
use App\Models\FoodItem; // FoodItem も使っているので use されているはず
use App\Models\FoodOrder; // FoodOrder も使っているので use されているはず
use App\Models\Invoice; // Invoice クラスの定義をここでインポート
use App\Users\Employee; // Employee クラスを使うので追加

class Restaurant {
    /** @var FoodItem[] $menu // メニューは FoodItem の配列 */
    private array $menu;
    /** @var Employee[] $employees */ 
    private array $employees;

    public function __construct(array $employees) {
        
        // レストランのメニューを初期化
        $this->menu = [
            new HawaiianPizza(12.50), // 価格を設定
            new Spaghetti(9.75),
            // 他のメニューアイテムをここに追加
        ];
        $this->employees = $employees;
        // ★★★ デバッグ用に追加 ★★★
        echo "--- Restaurant::__construct デバッグ情報 ---" . PHP_EOL;
        echo "メニューアイテム数: " . count($this->menu) . PHP_EOL;
        foreach ($this->menu as $item) {
            echo "  - " . $item->getName() . " (" . $item::getCategory() . ") - ¥" . $item->getPrice() . PHP_EOL;
        }
        echo "---------------------------------------" . PHP_EOL . PHP_EOL;
    } 

    /**
     * レストランの現在のメニューを取得します。
     * @return FoodItem[] メニューアイテムの配列
     */
    public function getMenu(): array {
        return $this->menu;
    }


    // $this->employees = $employees; // 従業員も後で初期化

    /**
     * 顧客からの注文を受け付け、請求書を生成する
     * @param string[] $categories 例: ['Pizza', 'Pasta'] クラス図の categories に対応
     */
    public function order(array $categories): Invoice {
        $orderedItems = []; // 実際に注文されたアイテムを格納する配列

        // クラス図の categories に基づいてメニューからアイテムを探し、orderedItems に追加
        foreach ($categories as $category) {
            $found = false;
            foreach ($this->menu as $menuItem) {
                // ここではカテゴリ名で判断するが、実際はもっと複雑なマッチングが必要になる場合も
                if (strtolower($menuItem::getCategory()) === strtolower($category)) { // static メソッド getCategory() を使用
                    $orderedItems[] = $menuItem;
                    $found = true;
                    break; // 各カテゴリから1つだけ選ぶ（簡略化のため）
                }
            }
            if (!$found) {
                // 注文されたカテゴリのアイテムが見つからなかった場合のエラー処理
                throw new \Exception("メニューに '" . $category . "' カテゴリのアイテムが見つかりませんでした。");
            }
        }

        if (empty($orderedItems)) {
            throw new \Exception("注文可能なアイテムが見つかりませんでした。");
        }
        
        $foodOrder = new FoodOrder($orderedItems);
        // 簡略化のため、推定提供時間は固定値（例: 30分）
        return new Invoice($foodOrder, 30);
    }
}