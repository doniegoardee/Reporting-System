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
            ['barangay' => 'Centro'],
            ['barangay' => 'Leron'],
            ['barangay' => 'Santa Maria'],
            ['barangay' => 'Cabaritan'],
            ['barangay' => 'Centro West'],
        ];

        DB::table('barangays')->insert($barangays);
    }
}

