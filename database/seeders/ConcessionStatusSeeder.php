<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConcessionStatusSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $statuses = [
            ['code' => 'pending', 'label' => 'Pending', 'is_terminal' => false, 'display_order' => 10],
            ['code' => 'submitted', 'label' => 'Submitted', 'is_terminal' => false, 'display_order' => 20],
            ['code' => 'under_review', 'label' => 'Under Review', 'is_terminal' => false, 'display_order' => 30],
            ['code' => 'approved', 'label' => 'Approved', 'is_terminal' => true, 'display_order' => 40],
            ['code' => 'rejected', 'label' => 'Rejected', 'is_terminal' => true, 'display_order' => 50],
            ['code' => 'cancelled', 'label' => 'Cancelled', 'is_terminal' => true, 'display_order' => 60],
        ];

        foreach ($statuses as $status) {
            DB::table('concession_statuses')->updateOrInsert(
                ['code' => $status['code']],
                [
                    'label' => $status['label'],
                    'is_terminal' => $status['is_terminal'],
                    'display_order' => $status['display_order'],
                    'created_at' => $status['created_at'] ?? $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
