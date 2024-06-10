<?php

use Illuminate\Database\Seeder;
use App\Models\Page;
use Illuminate\Support\Str;
class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'name' => [
                'uz' => 'Biz haqimizda',
                'ru' => 'О нас'
            ],
            'slug' => Str::slug('about'),
            'body' => [
                'uz' => 'content uz',
                'ru' => 'content ru'
            ],
            'type' => 1
        ]);

        Page::create([
            'name' => [
                'uz' => 'Policy',
                'ru' => 'Пользовательское соглашение'
            ],
            'slug' => Str::slug('Пользовательское соглашение'),
            'body' => [
                'uz' => 'content uz',
                'ru' => 'content ru'
            ],
            'type' => 2
        ]);

        Page::create([
            'name' => [
                'uz' => 'Yetkazib berish qoidalari',
                'ru' => 'Правила доставки'
            ],
            'slug' => Str::slug('Правила доставки'),
            'body' => [
                'uz' => 'content uz',
                'ru' => 'content ru'
            ],
            'type' => 3
        ]);
    }
}
