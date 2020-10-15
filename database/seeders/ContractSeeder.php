<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
		for ($i=1; $i < 50; $i++) {
		    DB::table('contracts')->insert([
                'contract_num' => 'CN#-'.str_pad($i, 10, "0", STR_PAD_LEFT),
                'customer_id' => $i,
                'contract_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'active'=>1,
                'plan_id' => 1,
                'contract_amount' => 200.00,
                'created_at' => '2020-10-'.$faker->numberBetween(1,5).' 20:20:20',
                'updated_at' => '2020-10-'.$faker->numberBetween(1,5).' 20:20:20',
            ]);
		}
    }
}
