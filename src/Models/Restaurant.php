<?php
namespace App\Models; // 名前空間は App\Models 

// 使うクラスを use する
use App\ConcreteFoods\HawaiianPizza;
use App\ConcreteFoods\Spaghetti;
use App\Models\FoodItem; // FoodItem も使っているので use されているはず
use App\Models\FoodOrder; // FoodOrder も使っているので use されているはず
use App\Models\Invoice; // Invoice クラスの定義をここでインポート

class Restaurant {
    /** @var FoodItem[] $menu // メニューは FoodItem の配列 */
    private array $menu;
    // private array $employees; // 後で追加するプロパティ

    public function __construct() {
        // レストランのメニューを初期化
        $this->menu = [
            new HawaiianPizza(12.50), // 価格を設定
            new Spaghetti(9.75),
            // 他のメニューアイテムをここに追加
        ];
        // ★★★ デバッグ用に追加 ★★★
        echo "--- Restaurant::__construct デバッグ情報 ---" . PHP_EOL;
        echo "メニューアイテム数: " . count($this->menu) . PHP_EOL;
        foreach ($this->menu as $item) {
            echo "  - " . $item->getName() . " (" . $item::getCategory() . ") - ¥" . $item->getPrice() . PHP_EOL;
        }
        echo "---------------------------------------" . PHP_EOL . PHP_EOL;
        // ★★★ ここまで追加したら、一度実行して何が表示されるか教えてください ★★★


        // $this->employees = $employees; // 従業員も後で初期化
    }

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
