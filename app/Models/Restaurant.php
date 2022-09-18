<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Restaurant extends Model {
    use HasFactory;
    use Sortable;

    public function categories() {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function regular_holidays() {
        return $this->belongsToMany(RegularHoliday::class)->withTimestamps();
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public $sortable = ['created_at'];

    // Sortableにおける独自のクエリ
    public function priceSortable($query, $direction) {
        // 最低価格と最高価格の平均を基準に並び替える
        return $query->orderByRaw("(lowest_price + highest_price) / 2 {$direction}");
    }

    // Sortableにおける独自のクエリ
    public function ratingSortable($query, $direction) {
        //  平均評価を求める        
        $reviews_average_score = Restaurant::withAvg('reviews', 'score')->get()->avg('reviews_avg_score');

        // 分散を求める
        $restaurants = Restaurant::withCount('reviews')->withAvg('reviews', 'score')->get();
        $reviews_score_variance_total = 0;
        foreach ($restaurants as $restaurant) {
            $reviews_score_variance_total += ($restaurant->reviews_avg_score - $reviews_average_score) ** 2;
        }
        $reviews_score_variance = $reviews_score_variance_total / $restaurants->count();

        // 標準偏差を求める        
        $reviews_score_standard_deviation = sqrt($reviews_score_variance);

        // 50を基準とする平均評価の偏差値の差分（平均評価の偏差値 - 50） × レビュー数
        return $query
            ->withCount('reviews')
            ->withAvg('reviews', 'score')
            ->orderByRaw("((reviews_avg_score - {$reviews_average_score}) * 10 / {$reviews_score_standard_deviation}) * reviews_count {$direction}");
    }

    // Sortableにおける独自のクエリ
    public function popularSortable($query, $direction) {
        // 予約数を基準に並び替える
        return $query->withCount('reservations')->orderBy('reservations_count', $direction);
    }
}
