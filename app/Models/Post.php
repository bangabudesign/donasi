<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'post_type',
        'published_at',
        'status',
        'body',
        'featured_image',
        'user_id',
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
        'published_at' => 'datetime:d, M Y H:i:s',
    ];

    public function getPublishedAtFormattedAttribute()
    { 
        return date("d, M Y H:i",strtotime($this->published_at));
    }

    public function getThumbnailAttribute()
    {
        return $this->featured_image ? url('/',$this->featured_image) : 'http://placehold.it/400X225';
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('published_at', 'DESC');
    }

    public function scopeActivePost($query)
    {
        return $query->where('status', self::ACTIVE)
            ->where('published_at', '<=', Carbon::now());
    }

    public function getNextPostAttribute()
    {
        $nextPost = self::activePost()
            ->where('published_at', '>', $this->published_at)
            ->orderBy('published_at', 'asc')
            ->first();

        return $nextPost;
    }

    public function getPrevPostAttribute()
    {
        $prevPost = self::activePost()
            ->where('published_at', '<', $this->published_at)
            ->orderBy('published_at', 'desc')
            ->first();

        return $prevPost;
    }
}
