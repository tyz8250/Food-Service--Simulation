<?php
// Composer のオートローダーを読み込む。
// これを読み込むことで、App\ で始まるクラスが自動的に使えるようになる！
require_once __DIR__ . '/vendor/autoload.php';

// 使うクラスを use する
use App\Users\Customer;
use App\Models\Restaurant;

echo "=== レストランシステムシミュレーション開始 ===" . PHP_EOL . PHP_EOL;

try {
    // 1. レストランのインスタンスを作成
    $restaurant = new Restaurant();

    // 2. 顧客のインスタンスを作成 (AbstractPerson のコンストラクタに従って引数を渡す)
    $customer1 = new Customer("ぱんちゃん", 30, "市役所前");

    // 3. 顧客がレストランに注文
    //    ここではカテゴリで注文する（クラス図の order(String[] categories) に対応）
    $invoice1 = $customer1->order($restaurant, ["Pizza", "Pasta"]);

    echo "--- ぱんちゃんの注文結果 ---" . PHP_EOL;
    echo "顧客名: " . $customer1->getName() . PHP_EOL;
    echo "請求額: ¥" . number_format($invoice1->getFinalPrice(), 2) . PHP_EOL;
    echo "注文時間: " . $invoice1->getOrderTime()->format('Y-m-d H:i:s') . PHP_EOL;
    echo "推定提供時間: " . $invoice1->getEstimatedTimeInMinutes() . "分" . PHP_EOL . PHP_EOL;

    // 別の顧客でも試す
    $customer2 = new Customer("まちさん", 28, "自宅");
    $invoice2 = $customer2->order($restaurant, ["Pizza"]); // ピザだけ注文

    echo "--- まちさんの注文結果 ---" . PHP_EOL;
    echo "顧客名: " . $customer2->getName() . PHP_EOL;
    echo "請求額: ¥" . number_format($invoice2->getFinalPrice(), 2) . PHP_EOL;
    echo "注文時間: " . $invoice2->getOrderTime()->format('Y-m-d H:i:s') . PHP_EOL;
    echo "推定提供時間: " . $invoice2->getEstimatedTimeInMinutes() . "分" . PHP_EOL . PHP_EOL;

} catch (\Exception $e) {
    // エラーが発生した場合
    echo "エラーが発生しました: " . $e->getMessage() . PHP_EOL;
}

echo "=== シミュレーション終了 ===" . PHP_EOL;