<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricingDetailSeeder extends Seeder
{
    public function run(): void
    {
        // Get pricing type IDs
        $pricingTypes = DB::table('pricing_types')->pluck('id', 'name');

        DB::table('pricing_details')->insert([
            [
                'pricing_type_id' => $pricingTypes['Paid'],
                'label' => 'Starts at $9/month',
            ],
            [
                'pricing_type_id' => $pricingTypes['Free'],
                'label' => 'Free for 3 users',
            ],
            [
                'pricing_type_id' => $pricingTypes['Paid'],
                'label' => 'Contact sales',
            ],
            [
                'pricing_type_id' => $pricingTypes['Lifetime'],
                'label' => 'One-time payment',
            ],
            [
                'pricing_type_id' => $pricingTypes['Paid'],
                'label' => 'Custom pricing',
            ],
        ]);
    }
}
