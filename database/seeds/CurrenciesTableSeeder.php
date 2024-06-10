<?php

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'euro' => 11500,
            'dollar' => 10280,
            'sum' => 1
        ]);
    }
}
