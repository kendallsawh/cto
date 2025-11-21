<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasurementUnitSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $units = [
            // Mass
            ['name' => 'kilogram', 'symbol' => 'kg', 'dimension' => 'mass'],
            ['name' => 'gram', 'symbol' => 'g', 'dimension' => 'mass'],
            ['name' => 'tonne', 'symbol' => 't', 'dimension' => 'mass'],
            ['name' => 'pound', 'symbol' => 'lb', 'dimension' => 'mass'],
            ['name' => 'ounce', 'symbol' => 'oz', 'dimension' => 'mass'],
            // Volume
            ['name' => 'liter', 'symbol' => 'L', 'dimension' => 'volume'],
            ['name' => 'milliliter', 'symbol' => 'mL', 'dimension' => 'volume'],
            ['name' => 'gallon', 'symbol' => 'gal', 'dimension' => 'volume'],
            ['name' => 'quart', 'symbol' => 'qt', 'dimension' => 'volume'],
            ['name' => 'pint', 'symbol' => 'pt', 'dimension' => 'volume'],
            // Length
            ['name' => 'meter', 'symbol' => 'm', 'dimension' => 'length'],
            ['name' => 'centimeter', 'symbol' => 'cm', 'dimension' => 'length'],
            ['name' => 'millimeter', 'symbol' => 'mm', 'dimension' => 'length'],
            ['name' => 'inch', 'symbol' => 'in', 'dimension' => 'length'],
            ['name' => 'foot', 'symbol' => 'ft', 'dimension' => 'length'],
            // Area
            ['name' => 'square meter', 'symbol' => 'm²', 'dimension' => 'area'],
            ['name' => 'hectare', 'symbol' => 'ha', 'dimension' => 'area'],
            ['name' => 'acre', 'symbol' => 'ac', 'dimension' => 'area'],
            // Count
            ['name' => 'piece', 'symbol' => 'pcs', 'dimension' => 'count'],
            ['name' => 'unit', 'symbol' => 'unit', 'dimension' => 'count'],
            ['name' => 'pack', 'symbol' => 'pk', 'dimension' => 'count'],
            // Concentration / misc
            ['name' => 'percent', 'symbol' => '%', 'dimension' => 'concentration'],
            ['name' => 'parts per million', 'symbol' => 'ppm', 'dimension' => 'concentration'],
            ['name' => 'gram per liter', 'symbol' => 'g/L', 'dimension' => 'concentration', 'notes' => 'agrochem dose label'],
        ];

        foreach ($units as $unit) {
            DB::table('measurement_units')->updateOrInsert(
                ['name' => $unit['name'], 'symbol' => $unit['symbol']],
                [
                    'dimension' => $unit['dimension'] ?? null,
                    'notes' => $unit['notes'] ?? null,
                    'created_at' => $unit['created_at'] ?? $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
