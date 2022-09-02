<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user = new User();
        $user->name = '侍 太郎';
        $user->kana = 'サムライ タロウ';
        $user->email = 'user@example.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('password');
        $user->postal_code = '0000000';
        $user->address = '東京都 港区 マンション';
        $user->phone_number = '09012345678';
        $user->birthday = '2000-04-01';
        $user->occupation = "エンジニア";
        $user->save();

        User::factory()->count(100)->create();
    }
}
