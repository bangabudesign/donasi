<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
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

    public function getThumbnailAttribute()
    {
        return $this->image ? url('/',$this->image) : 'https://via.placeholder.com/300X300';
    }
}
