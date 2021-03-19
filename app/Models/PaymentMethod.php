<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'type',
        'category',
        'name',
        'short_name',
        'detail_1',
        'detail_2',
        'detail_3',
        'image',
        'status',
    ];

    public const INACTIVE = 0;
    public const ACTIVE = 1;

    public const STATUSES = [
        self::INACTIVE => 'Inactive',
        self::ACTIVE => 'Active',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? url('/',$this->image) : 'http://placehold.it/70X39';
    }

    public function getStatusFormattedAttribute()
    {
        if ($this->status == self::ACTIVE) {
            return '<span class="badge badge-success">Active</span>';
        }else {
            return '<span class="badge badge-danger">Inactive</span>';
        }
    }
    
    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE);
    }
}
