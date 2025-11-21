<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemCategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $categories = [
            ['name' => 'Pesticides', 'description' => 'Chemical and biological pest control products.'],
            ['name' => 'Fertilizers', 'description' => 'Nutrients and soil amendments.'],
            ['name' => 'Seeds', 'description' => 'Seeds and planting materials.'],
            ['name' => 'Machinery', 'description' => 'Farm machinery and equipment.'],
            ['name' => 'Fishing Equipment', 'description' => 'Nets, lines, and other gear.'],
        ];

        foreach ($categories as $category) {
            DB::table('item_categories')->updateOrInsert(
                ['name' => $category['name']],
                [
                    'description' => $category['description'] ?? null,
                    'created_at' => $category['created_at'] ?? $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
