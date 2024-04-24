<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CargoType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        CargoType::factory()->create([
            CargoType::NAME => 'Autovežis',
        ]);
        CargoType::factory()->create([
            CargoType::NAME => 'Vilkikas su tentine priekaba'
        ]);
    }
}
