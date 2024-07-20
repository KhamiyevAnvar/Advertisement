<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Ban;
use App\Models\City;
use App\Models\Color;
use App\Models\Currency;
use App\Models\FuelType;
use App\Models\Gear;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();

        Ban::query()->insert([
            [
                ["name" => 'Avtobus'],
                ["name" => 'SUV'],
                ["name" => 'Motosiklet'],
                ["name" => 'Sedan'],
                ["name" => 'Fayton'],
                ["name" => 'Moped'],
            ]
        ]);

        FuelType::query()->insert([
            [
                ["name" => 'Benzin'],
                ["name" => 'Dizel'],
                ["name" => 'Elektrik'],
                ["name" => 'Qaz'],
                ["name" => 'Hibrid'],
            ]
        ]);

        Gear::query()->insert([
            [
                ["name" => 'Arxa'],
                ["name" => 'On'],
                ["name" => 'Tam']
            ]
        ]);

        Color::query()->insert([
            [
                ["name" => 'Ag'],
                ["name" => 'Qara'],
                ["name" => 'Boz'],
                ["name" => 'Yasil'],
                ["name" => 'Qirmizi']
            ]
        ]);

        City::query()->insert([
            [
                ["name" => 'Baki'],
                ["name" => 'Sumqayit'],
                ["name" => 'Gence'],
                ["name" => 'Lenkeran'],
                ["name" => 'Quba']
            ]
        ]);

        Currency::query()->insert([
            [
                [
                    "name" => 'Manat',
                    "code" => 'AZN'
                ],
                [
                    "name" => 'Dollar',
                    "code" => 'USD'
                ],
                [
                    "name" => 'Avro',
                    "code" => 'EUR'
                ],
            ]
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'admin@gmail.com',
        //     'email' => '12345',
        // ]);
    }
}
