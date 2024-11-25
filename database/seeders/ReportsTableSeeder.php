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

        // Iterate over each month of 2024
        for ($month = 1; $month <= 12; $month++) {
            // Generate a random number of records for each month (between 5 and 10)
            $recordsPerMonth = rand(5, 10);

            for ($i = 0; $i < $recordsPerMonth; $i++) {
                $date = Carbon::create(2024, $month, rand(1, 28), rand(0, 23), rand(0, 59), rand(0, 59));

                Reports::create([
                    'user_id' => 1, // Assuming 50 users exist
                    'subject_type' => $faker->randomElement(['flood', 'earthquake', 'fire', 'medical emergency', 'landslide']), // Assuming 10 incident types
                    'location' => $faker->address,
                    'status' => $faker->randomElement(['pending', 'closed', 'resolved']),
                    'description' => $faker->sentence(10),
                    'severity' => $faker->randomElement(['Low', 'Medium', 'High']),
                    'num_affected' => $faker->numberBetween(0, 500),
                    'needs' => $faker->sentence(5),
                    'image' => $faker->imageUrl(640, 480, 'incident'),
                    'contact' => $faker->phoneNumber,
                    'responding_agency' => $faker->company,
                    'resolved_time' => $faker->boolean(50) ? $date->addDays(rand(1, 7)) : null,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
