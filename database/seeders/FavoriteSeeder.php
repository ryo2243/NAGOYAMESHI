<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Restaurant;

class FavoriteSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = User::all();
        $restaurants = Restaurant::all();
        $number_of_restaurants = Restaurant::count() - 1;

        foreach ($users as $user) {
            // 設定するお気に入り数を0～10の間でランダムに決める
            $total = mt_rand(0, 10);

            //  設定する店舗のidを入れる配列を用意する
            $restaurant_ids = [];

            for ($i = 1; $i <= $total; $i++) {
                // 設定する店舗のidをランダムに決める
                $random_number = mt_rand(0, $number_of_restaurants);
                $restaurant_id = $restaurants[$random_number]->id;

                // 設定する店舗のidを配列の末尾に追加する
                $restaurant_ids[] = $restaurant_id;
            }

            $user->favorites()->sync($restaurant_ids);
        }
    }
}
