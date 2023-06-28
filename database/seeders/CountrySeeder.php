<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name' => 'Maldives',
            ],
            [
                'name' => 'India',
            ],
            [
                'name' => 'United States',
            ],
            [
                'name' => 'United Kingdom',
            ],
            [
                'name' => 'Nepal',
            ],
        ];

        Country::insert($countries);
    }
}
