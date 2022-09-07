<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RegularHoliday;

class RegularHolidaySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $regular_holiday = new RegularHoliday();
        $regular_holiday->day = '月';
        $regular_holiday->day_index = 1;
        $regular_holiday->save();

        $regular_holiday = new RegularHoliday();
        $regular_holiday->day = '火';
        $regular_holiday->day_index = 2;
        $regular_holiday->save();

        $regular_holiday = new RegularHoliday();
        $regular_holiday->day = '水';
        $regular_holiday->day_index = 3;
        $regular_holiday->save();

        $regular_holiday = new RegularHoliday();
        $regular_holiday->day = '木';
        $regular_holiday->day_index = 4;
        $regular_holiday->save();

        $regular_holiday = new RegularHoliday();
        $regular_holiday->day = '金';
        $regular_holiday->day_index = 5;
        $regular_holiday->save();

        $regular_holiday = new RegularHoliday();
        $regular_holiday->day = '土';
        $regular_holiday->day_index = 6;
        $regular_holiday->save();

        $regular_holiday = new RegularHoliday();
        $regular_holiday->day = '日';
        $regular_holiday->day_index = 0;
        $regular_holiday->save();

        $regular_holiday = new RegularHoliday();
        $regular_holiday->day = '不定休';
        $regular_holiday->day_index = null;
        $regular_holiday->save();
    }
}
