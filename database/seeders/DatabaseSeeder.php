<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
            'role' => 3
        ]);

        $faker = Faker::create();
		for ($i=0; $i < 50; $i++) {
		    \DB::table('payments')->insert([
                    'bank_id' => 1,
                    'customer_id'=> 9,
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
