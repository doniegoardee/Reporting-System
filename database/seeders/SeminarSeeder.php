<?php

namespace Database\Seeders;

use App\Models\Seminars;
use Illuminate\Database\Seeder;

class SeminarSeeder extends Seeder
{
    public function run()
    {
        Seminars::create([
            'title' => 'Disaster Preparedness Workshop',
            'description' => 'Learn how to prepare for disasters effectively.',
            'date' => '2024-12-20',
            'location' => 'Community Hall A',
        ]);

        Seminars::create([
            'title' => 'Climate Change Seminar',
            'description' => 'Discussing the impacts of climate change and solutions.',
            'date' => '2024-12-25',
            'location' => 'City Conference Center',
        ]);
    }
}
