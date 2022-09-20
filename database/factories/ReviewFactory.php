<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        $restaurants = Restaurant::all();
        $number_of_restaurants = Restaurant::count() - 1;
        $random_number_restaurant = mt_rand(0, $number_of_restaurants);
        $restaurant_id = $restaurants[$random_number_restaurant]->id;

        $users = User::all();
        $number_of_users = User::count() - 1;
        $random_number_user = mt_rand(0, $number_of_users);
        $user_id = $users[$random_number_user]->id;

        return [
            'content' => '名古屋では有名な格安で焼肉食べ放題のお店。タイミングよく仕事で行く機会があったので、地元の友人と一緒に来店しました。店内は広くゆったりとできます。',
            'score' => mt_rand(1, 5),
            'restaurant_id' => $restaurant_id,
            'user_id' => $user_id,
        ];
    }
}
