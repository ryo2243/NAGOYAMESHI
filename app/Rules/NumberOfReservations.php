<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Reservation;
use App\Models\Restaurant;

class NumberOfReservations implements Rule {
    private $number_of_people;
    private $restaurant_id;
    private $remaining_seats;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($number_of_people, $restaurant_id) {
        $this->number_of_people = $number_of_people;
        $this->restaurant_id = $restaurant_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
        $two_hours_later = date('Y-m-d H:i', strtotime($value . '+2 hours'));
        $two_hours_before = date('Y-m-d H:i', strtotime($value . '-2 hours'));

        // 予約日時の2時間前後の予約の総人数を取得する
        $total_people = Reservation::selectRaw('sum(number_of_people) as total_people')
            ->where([
                ['restaurant_id', $this->restaurant_id],
                ['reserved_datetime', '<', $two_hours_later],
                ['reserved_datetime', '>', $two_hours_before]
            ])
            ->pluck('total_people');

        $seating_capacity = Restaurant::find($this->restaurant_id)->seating_capacity;

        $this->remaining_seats = $seating_capacity - $total_people[0];

        return $this->number_of_people <= $this->remaining_seats;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        if ($this->remaining_seats === 0) {
            return 'その時間帯は満席です。';
        } else {
            return 'その時間帯の残り予約可能人数は' . $this->remaining_seats . '名です。';
        }
    }
}
