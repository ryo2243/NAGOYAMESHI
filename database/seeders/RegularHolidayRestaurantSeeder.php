<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\RegularHoliday;

class RegularHolidayRestaurantSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $restaurants = Restaurant::all();
        $regular_holidays = RegularHoliday::all();
        $number_of_regular_holidays = RegularHoliday::count() - 1;

        foreach ($restaurants as $restaurant) {
            // 設定する定休日の数を0～定休日データの数の間でランダムに決める
            $total = mt_rand(0, $number_of_regular_holidays);

            //  設定する定休日のidを入れる配列を用意する
            $regular_holiday_ids = [];

            for ($i = 1; $i <= $total; $i++) {
                // 設定する定休日のidをランダムに決める
                $random_number = mt_rand(0, $number_of_regular_holidays);
                $regular_holiday_id = $regular_holidays[$random_number]->id();

                // 設定する定休日のidを配列の末尾に追加する
                $regular_holiday_ids[] = $regular_holiday_id;
            }

            $restaurant->regular_holidays()->sync($regular_holiday_ids);
        }
    }
}
