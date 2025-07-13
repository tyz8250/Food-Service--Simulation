<?php
// Composer のオートローダーを読み込む。
// これを読み込むことで、App\ で始まるクラスが自動的に使える
require_once __DIR__ . '/vendor/autoload.php';

// 使うクラスを use する
use App\Users\Customer;
use App\Models\Restaurant;
use App\Users\Cashier; 
use App\Users\Chef;    


echo "=== レストランシステムシミュレーション開始 ===" . PHP_EOL . PHP_EOL;

try {
    // 1. 従業員のインスタンスを作成
    $cashier1 = new Cashier("レジ子", 25, "会計通り1-1", 1001, 250000.00);
    $chef1 = new Chef("料理長", 40, "厨房町2-2", 2001, 400000.00);
    
    // 2. レストランのインスタンスを作成(従業員を渡す)
    $restaurant = new Restaurant([$cashier1, $chef1]);

    // 3. 顧客のインスタンスを作成 (AbstractPerson のコンストラクタに従って引数を渡す)
    $customer1 = new Customer("ぱんちゃん", 30, "市役所前");

    echo "--- ぱんちゃんの注文 ---" . PHP_EOL;
    // 4. 顧客が Cashier に注文を依頼する（Cashier が FoodOrder を生成）
    //    Customer の order メソッドは、Cashier を呼び出すように変更するか、
    //    直接 Cashier の generateOrder を呼ぶ形にする。
    $foodOrder1 = $cashier1->generateOrder(["Pizza", "Pasta"], $restaurant);
    echo $chef1->prepareFood($foodOrder1) . PHP_EOL; // シェフが調理を開始

    // 5. Cashier が FoodOrder から Invoice を生成
    $invoice1 = $cashier1->generateInvoice($foodOrder1);

    echo "--- ぱんちゃんの注文結果 ---" . PHP_EOL;
    echo "顧客名: " . $customer1->getName() . PHP_EOL;
    echo "請求額: ¥" . number_format($invoice1->getFinalPrice(), 2) . PHP_EOL;
    echo "注文時間: " . $invoice1->getOrderTime()->format('Y-m-d H:i:s') . PHP_EOL;
    echo "推定提供時間: " . $invoice1->getEstimatedTimeInMinutes() . "分" . PHP_EOL . PHP_EOL;

    // 別の顧客でも試す
    $customer2 = new Customer("まちさん", 28, "自宅");
    $cashier2 = new Cashier("レジ男", 28, "会計通り1-2", 1002, 260000.00); // 別のキャッシャー
    $restaurant2 = new Restaurant([$cashier2]); // 別のレストラン（または同じレストランに異なる従業員）

    echo "--- まちさんの注文 ---" . PHP_EOL;
    $foodOrder2 = $cashier2->generateOrder(["Pizza"], $restaurant2);
    // chef1 は restaurant1 の従業員なので、ここでは chef1 を使わない。
    // もし restaurant2 に chef がいればその chef を使う。
    // 簡単のため、ここでは chef の調理メッセージは省略。
    $invoice2 = $cashier2->generateInvoice($foodOrder2);

    echo "--- まちさんの注文結果 ---" . PHP_EOL;
    echo "顧客名: " . $customer2->getName() . PHP_EOL;
    echo "担当キャッシャー: " . $cashier2->getName() . PHP_EOL;
    echo "請求額: ¥" . number_format($invoice2->getFinalPrice(), 2) . PHP_EOL;
    echo "注文時間: " . $invoice2->getOrderTime()->format('Y-m-d H:i:s') . PHP_EOL;
    echo "推定提供時間: " . $invoice2->getEstimatedTimeInMinutes() . "分" . PHP_EOL . PHP_EOL;

} catch (\Exception $e) {
    // エラーが発生した場合
    echo "エラーが発生しました: " . $e->getMessage() . PHP_EOL;
}

echo "=== シミュレーション終了 ===" . PHP_EOL;