<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Country\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        Country::factory()->count(5)->create();
    }
}