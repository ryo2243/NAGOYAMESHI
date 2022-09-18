<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AtLeastTwoHoursApart implements Rule {
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct() {
        //
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

        // 予約日時の2時間前後の予約がなければtrueを返す
        return Auth::user()
            ->reservations()
            ->where([
                ['reserved_datetime', '<', $two_hours_later],
                ['reserved_datetime', '>', $two_hours_before]
            ])
            ->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return 'その時間帯はすでに予約済みです。同日に予約する場合、少なくとも2時間以上空ける必要があります。';
    }
}
