<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'is_admin',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public function getProfilePhotoAttribute()
    {
        return 'https://ui-avatars.com/api/?name='.$this->name.'&color=48bb78&background=c6f6d5';
        // return $this->profile_photo ? url('/',$this->profile_photo) : 'https://ui-avatars.com/api/?name='.$this->name.'&amp;color=7F9CF5&amp;background=EBF4FF';
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    public function scopeNameFirst($query)
    {
        return $query->orderBy('name', 'ASC');
    }

    public function scopeContributor($query)
    {
        return $query->where('is_admin', 0);
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function campaigns()
    {
        return $this->hasMany('App\Models\Campaign');
    }

    public function donations()
    {
        return $this->hasMany('App\Models\Donation');
    }
}
