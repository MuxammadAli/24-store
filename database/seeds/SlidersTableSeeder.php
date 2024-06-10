<?php

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create([
            'name' => 'banner1',
            'link' => 'https://',
            'language' => 'ru',
            'type' => 'desktop',
            'image' => 'vendor/site/img/banner-img1.png',
            'placement' => 'top'
        ]);
    }
}
