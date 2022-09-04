<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        // 最低価格は500～10,000円かつ500で割り切れる価格にする
        $dummy_lowest_price = floor(mt_rand(500, 10000) / 500) * 500;
        // 開店時間は00:00～15:45かつ15分刻みにする（日本時間1970/01/02 00:00:00～1970/01/02 15:45:00のUNIXタイムスタンプを使用）
        $dummy_opening_time = date('H:i:s', floor(mt_rand(54000, 110700) / 900) * 900);

        return [
            'name' => $this->faker->name,
            'image' => basename('public/restaurants/dummy.jpg'),
            'description' => $this->faker->realText,
            'lowest_price' => $dummy_lowest_price,
            'highest_price' => $dummy_lowest_price + 2000,
            'postal_code' => $this->faker->postcode,
            'address' => $this->faker->prefecture . ' ' . $this->faker->city . $this->faker->streetAddress . ' ' . $this->faker->secondaryAddress,
            'opening_time' => $dummy_opening_time,
            'closing_time' => date('H:i:s', strtotime("{$dummy_opening_time} +8 hour")),
            'seating_capacity' => mt_rand(30, 150),
        ];
    }
}
