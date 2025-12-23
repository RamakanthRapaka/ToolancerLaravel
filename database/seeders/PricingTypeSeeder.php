<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pricing_types')->insert([
            ['name' => 'Free'],
            ['name' => 'Freemium'],
            ['name' => 'Paid'],
            ['name' => 'Lifetime'],
        ]);

    }
}
