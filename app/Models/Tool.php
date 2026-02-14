<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tool_name',

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

    /* =======================
     | Relationships
     ======================= */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
        return $this->belongsTo(PricingType::class, 'pricing_type_id');
    }

    public function pricingDetail()
    {
        return $this->belongsTo(PricingDetail::class, 'pricing_detail_id');
    }

    public function status()
    {
        return $this->belongsTo(ToolStatus::class, 'tool_status_id');
    }

    public function getLogoUrlAttribute()
    {
        if (! $this->logo) {
            return asset('img/default-tool.png');
        }

        // If already full URL (edge case safety)
        if (str_starts_with($this->logo, 'http')) {
            return $this->logo;
        }

        return asset('storage/'.$this->logo);
    }
}
