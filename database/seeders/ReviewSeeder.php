<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;

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
        $review->restaurant_id = 1;
        $review->user_id = 1;
        $review->save();

        Review::factory()->count(500)->create();
    }
}
