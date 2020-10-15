<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
		for ($i=1; $i < 10; $i++) {
		    \DB::table('banks')->insert([
                'name' => $faker->name,
                'account_number' => $faker->bankAccountNumber,
		        'holder' => $faker->name,
                'active'=>1,
                'created_at' => '2020-10-'.$faker->numberBetween(1,5).' 20:20:20',
                'updated_at' => '2020-10-'.$faker->numberBetween(1,5).' 20:20:20',
            ]);
		}
    }
}
