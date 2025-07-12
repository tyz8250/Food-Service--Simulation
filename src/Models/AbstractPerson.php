<?php
namespace App\Models;
use App\Interfaces\Person; //App\Interfaces名前空間に定義されているPersonインターフェースを参照

//抽象クラスを定義。直接インスタンス化できない。継承を前提。
abstract class AbstractPerson implements Person {
  // protected:そのクラス内と、そのクラスを継承する子クラスから継承可能
  protected string $name;
  protected int    $age;
  protected string $address;

  public function __construct(string $name,int $age,string $address){
    $this->name    = $name;
    $this->age     = $age;
    $this->address = $address;
  }
  public function getName(): string    { return $this->name; }
  public function getAge(): int        { return $this->age; }
  public function getAddress(): string { return $this->address; }
}
// 型の保証：implements Personにより、AbstractPersonを継承するすべてのクラスがPersonインターフェースの契約を満たすことが保証される。
// 設計の明確化：「人」という概念の基本的な定義と振る舞いを明確にすることで、システム全体の設計がより理解しやすくなる。