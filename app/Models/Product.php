<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'mood_id', 'category_id', 'is_deal', 
        'image', 'description', 
        'farmer_name', 'country_origin', 'altitude', 'farm_story', 'reward_points'
    ];

    public function mood()
    {
        return $this->belongsTo(Mood::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
