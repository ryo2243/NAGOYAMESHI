<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AtLeastTwoHoursInAdvance implements Rule {
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
        $now = now();
        $in_two_hours = date('Y-m-d H:i', strtotime($now . '+2 hours'));

        return $value >= $in_two_hours;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return '当日の予約は2時間前までにお願いいたします。';
    }
}
