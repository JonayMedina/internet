<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'id' => 1,
            'name' => 'Basico',
            'download' => 100,
            'upload' => 100,
            'unit_dw' => 'mb',
            'unit_up' => 'mb',
            'cost' => 200,
            'description' => 'Plan basico 100mb / 100mb',
            'active' => 1
        ]);
    }
}
