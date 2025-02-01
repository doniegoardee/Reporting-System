<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reports;
use Carbon\Carbon;
use Faker\Factory as Faker;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $now = Carbon::now();

        for ($month = 1; $month <= 12; $month++) {
            $recordsPerMonth = rand(5, 10);

            for ($i = 0; $i < $recordsPerMonth; $i++) {
                $date = Carbon::create(2024, $month, rand(1, 28), rand(0, 23), rand(0, 59), rand(0, 59));
                $date = $date->greaterThan($now) ? $now->copy()->subSeconds(rand(0, 3600)) : $date;

                $status = $faker->randomElement(['pending', 'closed', 'resolved', 'in-progress']);
                $resolvedTime = ($status === 'resolved' || $status === 'closed')
                    ? $date->copy()->addDays(rand(1, 7))->min($now)
                    : null;

                // Define subject type and responding agency mapping
                $subjectType = $faker->randomElement(['Flood', 'Earthquake', 'Fire Related', 'Medical Emergency', 'Robbery']);
                $respondingAgency = match ($subjectType) {
                    'Fire Related' => 'BFP',
                    'Earthquake' => 'MDRRMO',
                    'Robbery' => 'PNP',
                    default => $faker->randomElement(['MDRRMO', 'PNP']),
                };

                // Map images to subject types
                $image = match ($subjectType) {
                    'Flood' => 'flood_incident.jpg',
                    'Earthquake' => 'earthquake_incident.jpg',
                    'Fire Related' => 'fire_incident.jpg',
                    'Medical Emergency' => 'medical_incident.jpg',
                    'Robbery' => 'robbery_incident.jpg',
                };

                Reports::create([
                    'user_id' => 1,
                    'subject_type' => $subjectType,
                    'location' => $faker->randomElement(['Centro', 'Cabaritan', 'Centro Weste', 'Leron', 'Santa Maria']),
                    'zone' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7']),
                    'status' => $status,
                    'severity' => $faker->randomElement(['Low', 'Medium', 'High']),
                    'num_affected' => $faker->numberBetween(0, 500),
                    'needs' => $faker->sentence(5),
                    'image' => $image,
                    'contact' => $faker->phoneNumber,
                    'responding_agency' => $respondingAgency,
                    'email' => $faker->unique()->safeEmail,
                    'name' => $faker->name,
                    'resolved_time' => $resolvedTime,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
