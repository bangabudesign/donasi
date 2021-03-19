<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'code',
        'donation_target',
        'finished_at',
        'published_at',
        'status',
        'description',
        'short_description',
        'featured_image',
        'user_id',
        'verified_at',
        'verified_by',
    ];

    public const DRAFT = 0;
    public const ACTIVE = 1;
    public const INACTIVE = 2;

    public const STATUSES = [
        self::DRAFT => 'draft',
        self::ACTIVE => 'active',
        self::INACTIVE => 'inactive',
    ];

    public $casts = [
        'finished_at' => 'datetime:d, M Y H:i:s',
        'published_at' => 'datetime:d, M Y H:i:s',
    ];

    public function getStatusFormattedAttribute()
    { 
        switch ($this->status) {
            case self::ACTIVE:
                return '<span class="badge badge-success">Active</span>';
                break;
            case self::INACTIVE:
                return '<span class="badge badge-danger">Inactive</span>';
                break;
            default:
                return '<span class="badge badge-warning">Draft</span>';
                break;
        }
    }

    public function getDonationTargetFormattedAttribute()
    { 
        return number_format($this->donation_target);
    }

    public function getDonationCountAttribute()
    { 
        return number_format($this->donations()->paid()->count());
    }

    public function getDonationReceivedAttribute()
    { 
        return number_format($this->donations()->paid()->sum('amount'));
    }

    public function getDonationPercentageAttribute()
    { 
        return round(($this->donations()->paid()->sum('amount') / $this->donation_target * 100),2).'%';
    }

    public function getThumbnailAttribute()
    {
        return $this->featured_image ? url('/',$this->featured_image) : 'http://placehold.it/400X225';
    }

    public function getFinishedAtFormattedAttribute()
    { 
        return date("d, M Y H:i",strtotime($this->finished_at));
    }

    public function getPublishedAtFormattedAttribute()
    { 
        return date("d, M Y H:i",strtotime($this->published_at));
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('published_at', 'DESC');
    }

    public function scopeActiveCampaign($query)
    {
        return $query->where('status', self::ACTIVE)
            ->where('published_at', '<=', Carbon::now())
            ->where('verified_at', '<=', Carbon::now())
            ->where('finished_at', '>=', Carbon::now())
            ->orWhere('finished_at', null);
    }

    public function donations()
    {
        return $this->hasMany('App\Models\Donation');
    }
}
