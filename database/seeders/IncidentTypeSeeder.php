<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class IncidentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $incidentTypes = [
            [
                'name' => 'Flood',
                'image' => '1727670395.png',
                'color' => '#33a7ff',
                'agency' => 'MDRRMO',
                'contact' => '09123456789',
                'email' => 'ceyojdan13@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Earthquake',
                'image' => '1727670880.png',
                'color' => '#61511a',
                'agency' => 'MDRRMO',
                'contact' => '09123456789',
                'email' => 'ceyojdan13@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Medical Emergency',
                'image' => '1727670847.png',
                'color' => '#1ce93e',
                'agency' => 'MDRRMO',
                'contact' => '09123456789',
                'email' => 'ceyojdan13@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fire Related',
                'image' => 'fire.png',
                'color' => '#d91212',
                'agency' => 'BFP',
                'contact' => '09123456789',
                'email' => 'ceyojdan13@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('incident_types')->insert($incidentTypes);
    }
}
