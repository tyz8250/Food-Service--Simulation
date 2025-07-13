<?php
namespace App\Users;

use App\Models\AbstractPerson; //AbstractPersonを継承

class Employee extends AbstractPerson{
    protected int $employeeId; // 従業員ID
    protected float $salary; // 給与

    /**
     * AbstractPerson のプロパティに加え、employeeId と salary を初期化。
     *
     * @param string $name     名前
     * @param int    $age      年齢
     * @param string $address  住所
     * @param int    $employeeId 従業員ID
     * @param float  $salary   給与
     */
    
    public function __construct(string $name, int $age, string $address, int $employeeId, float $salary){
        // 親クラス（AbstractPerson）のコンストラクタを呼び出し、共通のプロパティを初期化
        parent::__construct($name, $age, $address);

        // Employee 独自のプロパティを初期化
        $this->employeeId = $employeeId;
        $this->salary = $salary;
    }

    /**
     * 従業員IDを取得。
     * @return int 従業員ID
     */
    public function getEmployeeId(): int {
        return $this->employeeId;
    }

    /**
     * 給与を取得。
     * @return float 給与
     */
    public function getSalary(): float {
        return $this->salary;
    }


}