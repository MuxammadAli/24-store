<?php

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::create([
            'username' => 'ulasoft-admin',
//            'email' => 'ulasoft@mail.ru',
            'password' => 'qwerty56',
            'role_id' => 1
        ]);

        Staff::create([
            'username' => 'content-moderator',
//            'email' => 'admin@mail.ru',
            'password' => 'qwerty56',
            'role_id' => 3
        ]);

        Staff::create([
            'username' => 'moderator',
//            'email' => 'admin@mail.ru',
            'password' => 'qwerty56',
            'role_id' => 4
        ]);
    }
}
