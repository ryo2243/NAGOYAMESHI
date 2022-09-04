<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;


class CategoryRestaurantSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $restaurants = Restaurant::all();
        $number_of_categories = Category::count();

        foreach ($restaurants as $restaurant) {
            // 設定するカテゴリ数を0～3の間でランダムに決める
            $total = mt_rand(0, 3);

            for ($i = 1; $i <= $total; $i++) {
                // 設定するカテゴリのidをランダムに決める
                $category_id = mt_rand(1, $number_of_categories);

                $restaurant->categories()->attach($category_id);
            }
        }
    }
}
