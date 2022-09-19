<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Restaurant;
use App\Models\User;

class ReviewSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $review = new Review();
        $review->content = 'とても美味しかったです。また利用させていただきます。';
        $review->score = 5;
        $review->restaurant_id = Restaurant::first()->id;
        $review->user_id = User::first()->id;
        $review->save();

        Review::factory()->count(500)->create();
    }
}
