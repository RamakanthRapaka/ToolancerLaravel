<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolSubCategory extends Model
{
    protected $fillable = ['tool_category_id', 'name', 'is_active'];

    public function category()
    {
        return $this->belongsTo(ToolCategory::class);
    }
}

