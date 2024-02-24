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
                'id_number' => $faker->numberBetween(3253622, 4782922),
                'pin' => $faker->numberBetween(1001, 9999),
                'nok_details' => $faker->text(),
                // 'category_id' => $faker->numberBetween(1, 10),
             ]);
         }
    }
}
