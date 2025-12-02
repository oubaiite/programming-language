<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AdminFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' =>'mouhammed oubai',
            'last_name' => 'jaber',
            'phone'=>'9875643210',
            'date_of_birth'=>'2000-5-27',
            'photo_of_personal_ID'=>'admin_photo.png',
            'personal_photo'=>'admin_photo.png',
            'role'=>'admin',
            'email' =>'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
