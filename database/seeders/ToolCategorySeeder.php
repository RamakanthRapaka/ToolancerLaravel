<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToolCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tool_categories')->insert([
            ['name' => 'AI Writing'],
            ['name' => 'Automation'],
            ['name' => 'SEO'],
        ]);

    }
}
