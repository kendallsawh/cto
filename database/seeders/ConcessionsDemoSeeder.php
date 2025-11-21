<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\ConcessionApplication;
use App\Models\Individual;
use App\Models\MeasurementUnit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConcessionsDemoSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $publicUser = User::firstOrCreate(
                ['email' => 'public@example.com'],
                [
                    'name' => 'Public Applicant',
                    'username' => 'public_applicant',
                    'password' => bcrypt('password'),
                ]
            );

            $staffUser = User::firstOrCreate(
                ['email' => 'staff@example.com'],
                [
                    'name' => 'Staff Reviewer',
                    'username' => 'staff_reviewer',
                    'password' => bcrypt('password'),
                ]
            );

            $company = Company::firstOrCreate(
                ['user_id' => $publicUser->id, 'company_name' => 'Agro Holdings'],
                [
                    'representative_name' => 'Agro Rep',
                    'address_street' => 'Agro Street',
                    'address_town' => 'Agro Town',
                ]
            );

            $individual = Individual::firstOrCreate(
                ['user_id' => $publicUser->id, 'national_id' => 'A1234567'],
                [
                    'address_street' => 'Main Street',
                    'address_town' => 'Capital City',
                ]
            );

            $kg = MeasurementUnit::where('symbol', 'kg')->first();
            $l = MeasurementUnit::where('symbol', 'L')->first();

            $pendingApplication = ConcessionApplication::create([
                'user_id' => $publicUser->id,
                'applicant_type' => Individual::class,
                'applicant_id' => $individual->id,
                'notes' => 'Demo pending application.',
            ]);

            $pendingApplication->items()->create([
                'item_name' => 'Hybrid Seeds',
                'unit_id' => $kg?->id,
                'unit_name_snapshot' => $kg?->name,
                'unit_symbol_snapshot' => $kg?->symbol,
                'quantity' => 10,
                'unit_value' => 5,
            ]);

            $submittedApplication = ConcessionApplication::create([
                'user_id' => $publicUser->id,
                'applicant_type' => Company::class,
                'applicant_id' => $company->id,
                'concession_status_id' => $this->getStatusId('submitted'),
                'submitted_at' => now(),
                'notes' => 'Demo submitted application.',
            ]);

            $submittedApplication->items()->create([
                'item_name' => 'Herbicide',
                'unit_id' => $l?->id,
                'unit_name_snapshot' => $l?->name,
                'unit_symbol_snapshot' => $l?->symbol,
                'quantity' => 20,
                'unit_value' => 15,
            ]);
        });
    }

    protected function getStatusId(string $code): ?int
    {
        return DB::table('concession_statuses')->where('code', $code)->value('id');
    }
}
