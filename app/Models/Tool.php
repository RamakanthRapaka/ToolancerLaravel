<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'tool_category_id',
        'tool_sub_category_id',
        'pricing_type_id',
        'pricing_detail_id',
        'tool_status_id',
        'affiliate_link',
        'logo',
        'demo_video',
        'demo_video_link',
        'tags',
        'official_reviews_url',
        'comparison_group',
        'rating',
        'use_cases',
        'features',
        'short_description',
        'full_description',
    ];

    public function category()
    {
        return $this->belongsTo(ToolCategory::class, 'tool_category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(ToolSubCategory::class, 'tool_sub_category_id');
    }

    public function pricingType()
    {
        return $this->belongsTo(PricingType::class);
    }

    public function pricingDetail()
    {
        return $this->belongsTo(PricingDetail::class);
    }

    public function status()
    {
        return $this->belongsTo(ToolStatus::class, 'tool_status_id');
    }
}

