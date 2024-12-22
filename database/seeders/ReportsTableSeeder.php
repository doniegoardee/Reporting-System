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
                // Generate a random date in the specified month and ensure it doesn't exceed today
                $date = Carbon::create(2024, $month, rand(1, 28), rand(0, 23), rand(0, 59), rand(0, 59));
                $date = $date->greaterThan($now) ? $now->copy()->subSeconds(rand(0, 3600)) : $date;

                // Set resolved_time only for "resolved" and "closed" statuses
                $status = $faker->randomElement(['pending', 'closed', 'resolved']);
                $resolvedTime = ($status === 'resolved' || $status === 'closed')
                    ? $date->copy()->addDays(rand(1, 7))->min($now)
                    : null;

                Reports::create([
                    'user_id' => 1,
                    'subject_type' => $faker->randomElement(['Flood', 'Earthquake', 'Fire Related', 'Medical Emergency']),
                    'location' => $faker->randomElement(['Centro', 'Cabaritan', 'Centro Weste', 'Leron', 'Santa Maria']),
                    'zone' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7']),
                    'status' => $status,
                    'severity' => $faker->randomElement(['Low', 'Medium', 'High']),
                    'num_affected' => $faker->numberBetween(0, 500),
                    'needs' => $faker->sentence(5),
                    'image' => $faker->imageUrl(640, 480, 'incident'),
                    'contact' => $faker->phoneNumber,
                    'responding_agency' => $faker->randomElement(['BFP', 'MDRRMO', 'PNP']),
                    'resolved_time' => $resolvedTime,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
