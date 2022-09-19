<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        $number_of_restaurants = Restaurant::count();
        $restaurant_id = mt_rand(1, $number_of_restaurants);
        $number_of_users = User::count();
        $opening_time = Restaurant::find($restaurant_id)->opening_time;
        $closing_time = Restaurant::find($restaurant_id)->closing_time;
        $seating_capacity = Restaurant::find($restaurant_id)->seating_capacity;
        $random_datetime = $this->faker->dateTimeBetween('-1 week', '+1 week');
        $random_date = $random_datetime->format("Y-m-d");
        $start_datetime = $random_date . ' ' . $opening_time;
        $end_datetime = $random_date . ' ' . $closing_time;

        return [
            'reserved_datetime' => $this->faker->dateTimeBetween($start_datetime, $end_datetime),
            'number_of_people' => mt_rand(1, $seating_capacity),
            'restaurant_id' => $restaurant_id,
            'user_id' => mt_rand(1, $number_of_users),
        ];
    }
}