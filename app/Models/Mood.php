<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    protected $fillable = ['name', 'theme_class', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
