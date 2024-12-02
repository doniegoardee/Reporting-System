<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class IncidentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $incidentTypes = [
            [
                'name' => 'Flood',
                'image' => '1727670395.png',
                'color' => '#33a7ff',
            ],
            [
                'name' => 'Earthquake',
                'image' => '1727670880.png',
                'color' => '#61511a',
            ],
            [
                'name' => 'Medical Emergency',
                'image' => '1727670847.png',
                'color' => '#1ce93e',
            ],
            [
                'name' => 'Fire Related',
                'image' => 'fire.png',
                'color' => '#d91212',
            ],
        ];

        DB::table('incident_types')->insert($incidentTypes);
    }
}
