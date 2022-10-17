<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = [
            [
                'name' => 'Rav 4',
                'color' => '#8F8FB3',
                'number' => 'А 503 О Х',
                'brand_id' => 7
            ],
            [
                'name' => 'Гелик G 63 AMG',
                'color' => '#ffffff',
                'number' => 'А 434 О K',
                'brand_id' => 1
            ],
            [
                'name' => 'Майбах 4MATIC',
                'color' => '#000000',
                'number' => 'Л 999 О Х',
                'brand_id' => 1
            ],
            [
                'name' => 'BMW X5 M50i IV',
                'color' => '#1B1BED',
                'number' => 'К 444 О M',
                'brand_id' => 2
            ],
            [
                'name' => 'Ferrari 488',
                'color' => '#CF123A',
                'number' => 'А 203 О Х',
                'brand_id' => 4
            ],
            [
                'name' => 'Lamborghini Aventador I Рестайлинг',
                'color' => '#1227F1',
                'number' => 'П 800 О Х',
                'brand_id' => 3
            ],
            [
                'name' => 'Land Cruiser Prado',
                'color' => '#2FEE1C',
                'number' => 'T 555 О Р',
                'brand_id' => 7
            ],
            [
                'name' => 'BMW M4',
                'color' => '#C707F6',
                'number' => 'Р 666 У Т',
                'brand_id' => 2
            ],
            [
                'name' => 'Нива',
                'color' => '#ffffff',
                'number' => 'А 228 У Е',
                'brand_id' => 6
            ],
            [
                'name' => 'Лада четырка',
                'color' => '#6B061A',
                'number' => 'А 322 У Е',
                'brand_id' => 6
            ]
        ];
        foreach ($cars as $car) {
            Car::updateOrCreate($car);
        }
    }
}
