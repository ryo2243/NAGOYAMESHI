<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $company = new Company();
        $company->name = 'NAGOYAMESHI株式会社';
        $company->postal_code = '1010022';
        $company->address = '東京都千代田区神田練塀町300番地 住友不動産秋葉原駅前ビル5F';
        $company->representative = '侍 太郎';
        $company->establishment_date = '2015年3月19日';
        $company->capital = '110,000千円';
        $company->business = '飲食店等の情報提供サービス';
        $company->number_of_employees = "83名";
        $company->save();
    }
}
