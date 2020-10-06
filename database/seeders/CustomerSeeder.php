<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
		for ($i=0; $i < 50; $i++) {
		    \DB::table('customers')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
		        'dni' => Str::random(10),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'birthdate' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'active'=>1,
                'created_at' => '2020-10-'.$faker->numberBetween(1,5).' 20:20:20',
                'updated_at' => '2020-10-'.$faker->numberBetween(1,5).' 20:20:20',
            ]);
		}
    }
}
