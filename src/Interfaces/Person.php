<?php
//Interfaces/Person.php
namespace App\Interfaces; //　名前空間の宣言
// 目的:クラス名やインターフェイス名が衝突するのを防ぐ。
// 役割:Interfaces という仮想の箱の中にPersonクラスを入れる。

interface Person{
    public function getName(): string;
    public function getAge(): int;
    public function getAddress(): string;
    // インターフェイスはメソッドの宣言のみ
}
