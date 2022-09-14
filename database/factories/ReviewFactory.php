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
        $number_of_restaurants = Restaurant::count();
        $number_of_users = User::count();

        return [
            'content' => $this->faker->realText,
            'score' => mt_rand(1, 5),
            'restaurant_id' => mt_rand(1, $number_of_restaurants),
            'user_id' => mt_rand(1, $number_of_users),
        ];
    }
}
