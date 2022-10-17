<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $brands = [
            [
                'name' => 'Мерседес',
                'country' => 'Германия'
            ],
            [
                'name' => 'БМВ',
                'country' => 'Германия'
            ],
            [
                'name' => 'Ламборгини',
                'country' => 'Италия'
            ],
            [
                'name' => 'Ферарри',
                'country' => 'Италия'
            ],
            [
                'name' => 'Рено',
                'country' => 'Франция'
            ],
            [
                'name' => 'Ваз',
                'country' => 'Россия'
            ],
            [
                'name' => 'Тойота',
                'country' => 'Япония'
            ]
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate($brand);
        }
    }
}
