<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToolSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::table('tool_categories')->pluck('id', 'name');

        DB::table('tool_sub_categories')->insert([
            // AI Writing
            ['tool_category_id' => $categories['AI Writing'], 'name' => 'Blog Writing'],
            ['tool_category_id' => $categories['AI Writing'], 'name' => 'Ad Copy'],
            ['tool_category_id' => $categories['AI Writing'], 'name' => 'Email Writing'],

            // Automation
            ['tool_category_id' => $categories['Automation'], 'name' => 'Workflow Automation'],
            ['tool_category_id' => $categories['Automation'], 'name' => 'RPA'],

            // SEO
            ['tool_category_id' => $categories['SEO'], 'name' => 'Keyword Research'],
            ['tool_category_id' => $categories['SEO'], 'name' => 'Site Audit'],
        ]);
    }
}
