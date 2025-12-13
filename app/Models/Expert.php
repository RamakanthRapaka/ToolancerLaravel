<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tags',
        'expertise_tags',
        'tools_known',
        'skills',
        'location',
        'languages',
        'rate',
        'portfolio_url',
        'short_bio',
        'profile_bio',
        'profile_file',
    ];
}
