<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public function scopeNameFirst($query)
    {
        return $query->orderBy('name', 'ASC');
    }

    public function campaigns()
    {
        return $this->hasMany('App\Models\Campaign', 'category_id');
    }
}
