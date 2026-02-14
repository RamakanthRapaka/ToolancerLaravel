<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingDetail extends Model
{
    protected $fillable = ['pricing_type_id', 'label', 'is_active'];

    public function pricingType()
    {
        return $this->belongsTo(PricingType::class);
    }
}
