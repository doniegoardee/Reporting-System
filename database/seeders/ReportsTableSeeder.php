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
                // Generate a random date
                $date = Carbon::create(2024, $month, rand(1, 28), rand(0, 23), rand(0, 59), rand(0, 59));

                // Ensure the date does not exceed the current date
                if ($date->greaterThan($now)) {
                    $date = $now->copy()->subSeconds(rand(0, 3600 * 24)); // Random time within the last day
                }

                Reports::create([
                    'user_id' => 1,
                    'subject_type' => $faker->randomElement(['Flood', 'Earthquake', 'Fire Related', 'Medical Emergency']),
                    'location' => $faker->randomElement(['Centro', 'Cabaritan', 'Centro Weste', 'Leron', 'Santa Maria']),
                    'status' => $faker->randomElement(['pending', 'closed', 'resolved']),
                    'severity' => $faker->randomElement(['Low', 'Medium', 'High']),
                    'num_affected' => $faker->numberBetween(0, 500),
                    'needs' => $faker->sentence(5),
                    'image' => $faker->imageUrl(640, 480, 'incident'),
                    'contact' => $faker->phoneNumber,
                    'responding_agency' => $faker->company,
                    'resolved_time' => $faker->boolean(50) ? $date->addDays(rand(1, 7))->min($now) : null, // Ensure resolved_time doesn't exceed now
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
