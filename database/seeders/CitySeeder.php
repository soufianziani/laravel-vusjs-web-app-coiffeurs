<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $cities = [
        'Casablanca',
        'Rabat',
        'Fes',
        'Tangier',
        'Marrakech',
        'Agadir',
        'Meknes',
        'Oujda',
        'Kenitra',
        'Tetouan',
    ];

    public function run(): void
    {

        foreach ($this->cities as $cityName) {
            City::create([
                
                'name' => $cityName
            ]);
        }
    }
}
