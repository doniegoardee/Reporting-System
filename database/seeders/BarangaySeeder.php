<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangays = [
            [
                'barangay' => 'Centro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barangay' => 'Leron',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barangay' => 'Santa Maria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barangay' => 'Cabaritan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barangay' => 'Centro West',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('barangays')->insert($barangays);
    }
}
