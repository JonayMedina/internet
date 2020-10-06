<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PaymentSeeder extends Seeder
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
		    \DB::table('payments')->insert([
                    'bank_id' => $faker->numberBetween(1,9),
                    'customer_id'=> $faker->numberBetween(1,49),
                    'amount' => $faker->randomNumber(3),
                    'payment_date' => '2020-10-'.$faker->numberBetween(1,5),
                    'active'=>1,
                    'payment_num' => $faker->randomNumber(5),
		            'created_at' => '2020-10-'.$faker->numberBetween(1,5).' 20:20:20',
		            'updated_at' => '2020-10-'.$faker->numberBetween(1,5).' 20:20:20',
            ]);
		}
    }
}
