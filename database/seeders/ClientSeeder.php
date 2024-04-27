<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $faker = Faker::create();

         // Generate multiple fake agent records
         for ($i = 0; $i < 10; $i++) {
             Client::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address(),
                'phone' => $faker->phoneNumber(),
             ]);
         }
    }
}
