<?php

use App\User;
use App\Models\Address;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        User::create([
//            'first_name' => 'ulasoft',
//            'last_name' => 'ulasoft',
//            'password' => 'qwerty56',
//            'role_id' => 1,
//            'phone' => '998913333111',
//        ]);
//
//        User::create([
//            'first_name' => 'admin',
//            'last_name' => 'Adminovich',
//            'password' => 'qwerty56',
//            'role_id' => 1,
//            'phone' => '998971234567',
//        ]);
//        User::create([
//            'first_name' => 'Jasurbek',
//            'last_name' => 'Abdurakhmonov',
//            'password' => 'qwerty56',
//            'role_id' => 1,
//            'phone' => '998998973290',
//        ]);

        User::create([
            'first_name' => 'Ulasoft',
            'last_name' => 'Tukhtaev',
            'role_id' => 2,
            'phone' => '998913333111',
        ]);

        Address::create([
           'name' => 'Дом',
           'city' => 'Ташкент',
           'region' => 'Юнусабад',
           'address' => '1 kvartal 46-2',
            'phone' => 998913333111,
            'user_id' => 1,
            'location' => [
                'lat' => 41.2921056,
                'lng' => 69.251982
            ]
        ]);
    }
}
