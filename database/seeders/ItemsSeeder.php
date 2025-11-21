<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $categoryIds = DB::table('item_categories')
            ->whereIn('name', ['Pesticides', 'Fertilizers', 'Seeds', 'Machinery', 'Fishing Equipment'])
            ->pluck('id', 'name');

        $unitIds = DB::table('measurement_units')
            ->whereIn('symbol', ['L', 'kg', 'pcs'])
            ->pluck('id', 'symbol');

        $items = [
            [
                'item_category_id' => $categoryIds['Pesticides'] ?? null,
                'name' => 'Herbicide Concentrate',
                'default_unit_id' => $unitIds['L'] ?? null,
                'metadata' => json_encode(['active_ingredient' => 'Glyphosate']),
            ],
            [
                'item_category_id' => $categoryIds['Fertilizers'] ?? null,
                'name' => 'NPK Fertilizer 15-15-15',
                'default_unit_id' => $unitIds['kg'] ?? null,
                'metadata' => json_encode(['grade' => '15-15-15']),
            ],
            [
                'item_category_id' => $categoryIds['Seeds'] ?? null,
                'name' => 'Hybrid Corn Seeds',
                'default_unit_id' => $unitIds['kg'] ?? null,
                'metadata' => json_encode(['variety' => 'HYB-001']),
            ],
            [
                'item_category_id' => $categoryIds['Machinery'] ?? null,
                'name' => 'Compact Tractor',
                'default_unit_id' => $unitIds['pcs'] ?? null,
                'metadata' => json_encode(['model' => 'CT-200']),
            ],
            [
                'item_category_id' => $categoryIds['Fishing Equipment'] ?? null,
                'name' => 'Fishing Net',
                'default_unit_id' => $unitIds['pcs'] ?? null,
                'metadata' => json_encode(['size' => '50m']),
            ],
        ];

        foreach ($items as $item) {
            if (! $item['item_category_id']) {
                continue;
            }

            DB::table('items')->updateOrInsert(
                ['name' => $item['name'], 'item_category_id' => $item['item_category_id']],
                [
                    'default_unit_id' => $item['default_unit_id'],
                    'metadata' => $item['metadata'],
                    'created_at' => $item['created_at'] ?? $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
