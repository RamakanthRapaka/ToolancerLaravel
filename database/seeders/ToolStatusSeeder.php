<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToolStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tool_statuses')->insert([
            ['name' => 'Pending'],
            ['name' => 'Active'],
            ['name' => 'Rejected'],
        ]);
    }
}
