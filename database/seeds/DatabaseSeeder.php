<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(SettingSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(StaffsTableSeeder::class);
        $this->call(PartnersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SlidersTableSeeder::class);
        $this->call(SpecialOffersTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(CompilationsTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CoinCompilationSeeder::class);
    }
}
