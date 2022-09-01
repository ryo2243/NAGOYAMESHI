<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'name' => $this->faker->lastName . ' ' . $this->faker->firstName,
            'kana' => $this->faker->lastKanaName . ' ' . $this->faker->firstKanaName,
            'email' => $this->faker->email,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'postal_code' => $this->faker->postcode,
            'address' => $this->faker->prefecture . ' ' . $this->faker->city . $this->faker->streetAddress . ' ' . $this->faker->secondaryAddress,
            'phone_number' => $this->faker->phoneNumber,
            'birthday' => $this->faker->dateTime,
            'occupation' => $this->faker->jobTitle,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified() {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
