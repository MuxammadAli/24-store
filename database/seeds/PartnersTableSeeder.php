<?php

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Partner::create([
           'name' => 'Jefferson',
            'image' => 'vendor/site/img/partner-logo1.png'
        ]);

        Partner::create([
            'name' => 'Pavement',
            'image' => 'vendor/site/img/partner-logo2.png'
        ]);

        Partner::create([
            'name' => 'Sticks',
            'image' => 'vendor/site/img/partner-logo3.png'
        ]);

        Partner::create([
            'name' => 'Colony',
            'image' => 'vendor/site/img/partner-logo4.png'
        ]);

        Partner::create([
            'name' => 'Tennis',
            'image' => 'vendor/site/img/partner-logo5.png'
        ]);

        Partner::create([
            'name' => 'Koton',
            'image' => 'vendor/site/img/partner-logo6.png'
        ]);
    }
}
