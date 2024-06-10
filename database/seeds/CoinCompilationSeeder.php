<?php

use App\Models\CoinProduct;
use App\Models\Compilation;
use Illuminate\Database\Seeder;

class CoinCompilationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $compilation = Compilation::create([
            'title' => [
                'ru' => 'Товары',
                'uz' => 'Mahsulotlar'
            ],
            'position' => 1,
            'type' => 'coin'
        ]);
        $compilation->coin_products()->attach(CoinProduct::all()->pluck('id'));
    }
}
