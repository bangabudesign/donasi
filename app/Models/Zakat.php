<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zakat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function scopeNameFirst($query)
    {
        return $query->orderBy('name', 'ASC');
    }

    public function transactions()
    {
        return $this->morphMany('App\Models\Transaction', 'transactionable');
    }
}
