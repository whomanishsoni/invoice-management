<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

<<<<<<< HEAD
        for ($i = 0; $i < 5000; $i++) {
=======
        for ($i = 0; $i < 10000; $i++) {
>>>>>>> bca396dd42703295621096a87fe7a46b24c33ec8
            DB::table('customers')->insert([
                'name'       => $faker->name,
                'email'      => $faker->unique()->safeEmail,
                'phone'      => $faker->phoneNumber,
                'address'    => $faker->address,
                'city'       => $faker->city,
                'state_id'   => rand(1, 10), // Assuming you have state IDs from 1 to 10
                'gst_number' => $faker->optional()->regexify('[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
