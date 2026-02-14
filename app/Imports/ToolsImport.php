<?php

namespace App\Imports;

use App\Models\PricingDetail;
use App\Models\PricingType;
use App\Models\Tool;
use App\Models\ToolCategory;
use App\Models\ToolSubCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ToolsImport implements ToCollection, WithHeadingRow
{
    private $successCount = 0;
    private $failureCount = 0;

    // Detect the name column for each table
    private function getNameColumn($table)
    {
        $columns = Schema::getColumnListing($table);
        
        // Check for common name column variations
        if (in_array('name', $columns)) {
            return 'name';
        } elseif (in_array('label', $columns)) {
            return 'label';
        } elseif (in_array('title', $columns)) {
            return 'title';
        }
        
        return 'name'; // default fallback
    }

    private function findOrCreateByName($model, $value, $additionalData = [])
    {
        if (empty($value)) {
            return null;
        }

        $table = (new $model)->getTable();
        $nameColumn = $this->getNameColumn($table);

        Log::info("Using column '{$nameColumn}' for table '{$table}'");

        return $model::firstOrCreate(
            [$nameColumn => $value],
            array_merge([$nameColumn => $value], $additionalData)
        );
    }

    public function collection(Collection $rows)
    {
        Log::info('Starting import with ' . $rows->count() . ' rows');

        foreach ($rows as $index => $row) {
            try {
                Log::info('Processing row ' . ($index + 2), $row->toArray());

                // Get tool name
                $toolName = $row['tool_name'] ?? null;

                if (empty($toolName)) {
                    Log::warning('Skipping row ' . ($index + 2) . ': tool_name is empty');
                    $this->failureCount++;
                    continue;
                }

                // Get or create category (REQUIRED)
                $categoryName = $row['tool_category'] ?? null;

                if (empty($categoryName)) {
                    Log::warning('Skipping row ' . ($index + 2) . ': tool_category is empty');
                    $this->failureCount++;
                    continue;
                }

                $category = $this->findOrCreateByName(
                    ToolCategory::class,
                    $categoryName,
                    ['description' => $categoryName . ' category (auto-created)']
                );

                if ($category->wasRecentlyCreated) {
                    Log::info("✨ Created new category: {$categoryName}");
                }

                // Get or create sub-category (OPTIONAL)
                $subCategory = null;
                $subCategoryName = $row['sub_category'] ?? null;

                if (!empty($subCategoryName)) {
                    $subCategory = $this->findOrCreateByName(
                        ToolSubCategory::class,
                        $subCategoryName,
                        [
                            'tool_category_id' => $category->id, // ✅ Link to parent category
                            'description' => $subCategoryName . ' sub-category (auto-created)',
                        ]
                    );

                    if ($subCategory->wasRecentlyCreated) {
                        Log::info("✨ Created new sub-category: {$subCategoryName}");
                    }
                }

                // Get or create pricing type (OPTIONAL)
                $pricingType = null;
                $pricingTypeName = $row['pricing_type'] ?? null;

                if (!empty($pricingTypeName)) {
                    $pricingType = $this->findOrCreateByName(
                        PricingType::class,
                        $pricingTypeName,
                        ['description' => $pricingTypeName . ' pricing (auto-created)']
                    );

                    if ($pricingType->wasRecentlyCreated) {
                        Log::info("✨ Created new pricing type: {$pricingTypeName}");
                    }
                }

                // Get or create pricing detail (OPTIONAL)
                $pricingDetail = null;
                $pricingDetailName = $row['pricing_details'] ?? null;

                if (!empty($pricingDetailName) && $pricingType) {
                    // ✅ IMPORTANT: Link pricing detail to pricing type
                    $pricingDetail = $this->findOrCreateByName(
                        PricingDetail::class,
                        $pricingDetailName,
                        [
                            'pricing_type_id' => $pricingType->id, // ✅ Link to parent pricing type
                            'description' => $pricingDetailName . ' billing (auto-created)',
                        ]
                    );

                    if ($pricingDetail->wasRecentlyCreated) {
                        Log::info("✨ Created new pricing detail: {$pricingDetailName} under {$pricingTypeName}");
                    }
                }

                // Create the tool
                $data = [
                    'tool_name' => $toolName,
                    'tool_category_id' => $category->id,
                    'tool_sub_category_id' => $subCategory?->id,
                    'affiliate_link' => $row['affiliate_link'] ?? null,
                    'pricing_type_id' => $pricingType?->id,
                    'pricing_detail_id' => $pricingDetail?->id,
                    'logo' => $row['tool_logo'] ?? null,
                    'demo_video' => $row['demo_video_of_tool'] ?? null,
                    'demo_video_link' => $row['video_of_tool_link'] ?? null,
                    'tags' => $row['tags'] ?? null,
                    'official_reviews_url' => $row['official_reviews_url'] ?? null,
                    'comparison_group' => $row['tool_comparison_group'] ?? null,
                    'use_cases' => $row['use_cases'] ?? null,
                    'features' => $row['features'] ?? null,
                    'short_description' => $row['short_description'] ?? null,
                    'full_description' => $row['full_description'] ?? null,
                    'tool_status_id' => 1,
                    'user_id' => auth()->id() ?? 1,
                ];

                Log::info('Creating tool:', $data);

                $tool = Tool::create($data);

                Log::info("✓ Successfully created tool ID: {$tool->id} - {$tool->tool_name}");
                $this->successCount++;

            } catch (\Exception $e) {
                Log::error('✗ Failed to import row ' . ($index + 2) . ': ' . $e->getMessage(), [
                    'row_data' => $row->toArray(),
                    'error' => $e->getMessage(),
                ]);
                $this->failureCount++;
            }
        }

        Log::info('========================================');
        Log::info('Import Summary:');
        Log::info("  ✓ Success: {$this->successCount} tools imported");
        Log::info("  ✗ Failed: {$this->failureCount} rows skipped");
        Log::info('========================================');
    }

    public function getSuccessCount()
    {
        return $this->successCount;
    }

    public function getFailureCount()
    {
        return $this->failureCount;
    }
}