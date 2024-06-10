<?php

use Illuminate\Database\Seeder;
use App\Models\Compilation;

class CompilationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Compilation::create([
            'title' => [
                'uz' => 'Лидер продаж',
                'ru' => 'Лидер продаж'
            ],
            'position' => 2,
            'published' => true,
        ]);

        Compilation::create([
            'title' => [
                'uz' => 'Ommabop mahsulotlar',
                'ru' => 'Популярные товары'
            ],
            'position' => 1,
            'published' => true,
        ]);

        Compilation::create([
            'title' => [
                'uz' => 'Yangi mahsulotlar',
                'ru' => 'Новые товары'
            ],
            'position' => 1,
            'published' => true,
        ]);
    }
}
