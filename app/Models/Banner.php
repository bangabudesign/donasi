<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'link',
        'image',
    ];

    public function getThumbnailAttribute()
    {
        return $this->image ? url('/',$this->image) : 'http://placehold.it/1080X400';
    }
}
