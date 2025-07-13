<?php
namespace App\Users; // 名前空間は App\Users 

// 使うクラスを use する
use App\Users\Employee;
use App\Models\FoodOrder;
use App\Models\Invoice;
use App\Models\Restaurant;
use App\Models\FoodItem; // FoodItem も使うので use する

class Cashier extends Employee {
    /**
     * Cashier クラスのコンストラクタ
     *
     * @param string $name     名前
     * @param int    $age      年齢
     * @param string $address  住所
     * @param int    $employeeId 従業員ID
     * @param float  $salary   給与
     */
    public function __construct(string $name, int $age, string $address, int $employeeId, float $salary) {
        // 親クラス（Employee）のコンストラクタを呼び出し
        parent::__construct($name, $age, $address, $employeeId, $salary);
    }

    /**
     * 顧客の注文カテゴリとレストラン情報に基づいて FoodOrder を生成。
     * クラス図によると、Cashier が FoodOrder を生成する責務を持つ。
     *
     * @param string[] $categories 顧客が注文したカテゴリのリスト (例: ['Pizza', 'Pasta'])
     * @param Restaurant $restaurant 注文を受けるレストラン
     * @return FoodOrder 生成された FoodOrder オブジェクト
     * @throws \Exception 注文可能なアイテムが見つからない場合
     */
    public function generateOrder(array $categories, Restaurant $restaurant): FoodOrder {
        echo $this->getName() . "が顧客の注文 (" . implode(', ', $categories) . ") を受け付けます。" . PHP_EOL;

        $orderedItems = [];
        $menuItems = $restaurant->getMenu(); // レストランからメニューを取得

        foreach ($categories as $category) {
            $found = false;
            foreach ($menuItems as $menuItem) {
                // 大文字・小文字を区別せずカテゴリを比較
                if (strtolower($menuItem::getCategory()) === strtolower($category)) {
                    $orderedItems[] = $menuItem;
                    $found = true;
                    break; // 各カテゴリから1つだけ選ぶ（簡略化）
                }
            }
            if (!$found) {
                throw new \Exception("注文されたカテゴリ '" . $category . "' のアイテムがメニューに見つかりませんでした。");
            }
        }

        if (empty($orderedItems)) {
            throw new \Exception("注文可能なアイテムが選択されませんでした。");
        }

        return new FoodOrder($orderedItems); // FoodOrder を生成して返す
    }

    /**
     * 指定された FoodOrder に基づいて Invoice を生成します。
     *
     * @param FoodOrder $foodOrder 生成対象の FoodOrder
     * @return Invoice 生成された Invoice オブジェクト
     */
    public function generateInvoice(FoodOrder $foodOrder): Invoice {
        echo $this->getName() . "が請求書を生成します。" . PHP_EOL;
        // 簡易的に推定提供時間を30分とします。
        // 実際には、注文内容やレストランの混雑状況によって計算されます。
        return new Invoice($foodOrder, 30);
    }
}