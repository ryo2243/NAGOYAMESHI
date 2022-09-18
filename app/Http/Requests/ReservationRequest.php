<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AtLeastTwoHoursInAdvance;
use App\Rules\AtLeastTwoHoursApart;
use App\Rules\NumberOfReservations;

class ReservationRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        $number_of_people = $this->input('number_of_people');
        $restaurant_id = $this->input('restaurant_id');

        return [
            'reservation_date' => ['required', 'date_format:Y-m-d'],
            'reservation_time' => ['required', 'date_format:H:i'],
            'reservation_datetime' => [new AtLeastTwoHoursInAdvance, new AtLeastTwoHoursApart, new NumberOfReservations($number_of_people, $restaurant_id)],
            'number_of_people' => ['required', 'numeric', 'between:1,50']
        ];
    }

    protected function prepareForValidation() {
        $reservation_datetime = $this->reservation_date . ' ' . $this->reservation_time;
        $this->merge([
            'reservation_datetime' => $reservation_datetime
        ]);
    }
}
