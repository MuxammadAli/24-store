<?php

use Illuminate\Database\Seeder;
use App\Models\SpecialOffer;

class SpecialOffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpecialOffer::create([
            'name' => [
                'uz' => 'Новое поступление техники Apple',
                'ru' => 'Новое поступление техники Apple'
            ],
            'description' => [
                'uz' => 'от 399$',
                'ru' => 'от 399$',
            ],
            'link' => 'https://',
            'image' => 'vendor/site/img/special_img1.png'
        ]);

        SpecialOffer::create([
            'name' => [
                'uz' => 'Скидки до 50% на смарт часы',
                'ru' => 'Скидки до 50% на смарт часы'
            ],
            'description' => [
                'uz' => 'Apple watch',
                'ru' => 'Apple watch',
            ],
            'link' => 'https://',
            'image' => 'vendor/site/img/special_img2.png'
        ]);

        SpecialOffer::create([
            'name' => [
                'uz' => 'Powerbeats без предоплаты',
                'ru' => 'Powerbeats без предоплаты'
            ],
            'description' => [
                'uz' => 'от 249$',
                'ru' => 'от 249$',
            ],
            'link' => 'https://',
            'image' => 'vendor/site/img/special_img3.png'
        ]);
    }
}
