<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Category;


class CategoryRestaurantSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $restaurants = Restaurant::all();
        $categories = Category::all();
        $number_of_categories = Category::count();

        foreach ($restaurants as $restaurant) {
            // 設定するカテゴリ数を0～3の間でランダムに決める
            $total = mt_rand(0, 3);

            //  設定するカテゴリのidを入れる配列を用意する
            $category_ids = [];

            for ($i = 1; $i <= $total; $i++) {
                // 設定するカテゴリのidをランダムに決める
                $random_number = mt_rand(1, $number_of_categories);
                $category_id = $categories[$random_number]->id;

                // 設定するカテゴリのidを配列の末尾に追加する
                $category_ids[] = $category_id;
            }

            $restaurant->categories()->sync($category_ids);
        }
    }
}
