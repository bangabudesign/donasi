<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'invoice',
        'campaign_id',
        'user_id',
        'payment_method_id',
        'amount',
        'is_anonim',
        'comment',
        'status',
        'payment_date',
        'payment_detail_1',
        'payment_detail_2',
        'payment_detail_3',
        'payment_status',
        'verified_at',
        'verified_by',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'verified_at'
    ];

    public const CANCEL = 0;
    public const SUCCESS = 1;
    public const UNPAID = 0;
    public const PAID = 1;
    public const PENDING = 2;

    public const STATUSES = [
        self::CANCEL => 'Cancel',
        self::SUCCESS => 'Success',
        self::UNPAID => 'Unpaid',
        self::PAID => 'Paid',
        self::PENDING => 'Pending',
    ];

    public function getDisplayNameAttribute()
    { 
        if ($this->is_anonim) {
            return "Hamba Allah";
        } else {
            return $this->user->name;
        }
    }

    public function getDisplayProfileAttribute()
    {
        if ($this->is_anonim) {
            return 'https://ui-avatars.com/api/?name=Hamba%20Allah&color=48bb78&background=c6f6d5';
        } else {
            return $this->user->profile_photo;
        }
    }

    public function getAmountFormattedAttribute()
    { 
        return number_format($this->amount);
    }

    public function getCreatedAtFormattedAttribute()
    { 
        return date("d, M Y H:i",strtotime($this->created_at));
    }

    public function getExpiredAtAttribute()
    { 
        return date("d, M Y H:i:s",strtotime($this->created_at. '+3 hours'));
    }

    public function getStatusFormattedAttribute()
    {
        if ($this->status == self::SUCCESS) {
            return '<span class="badge badge-success">Success</span>';
        }else {
            return '<span class="badge badge-danger">Cancel</span>';
        }
    }

    public function getPaymentStatusFormattedAttribute()
    { 
        switch ($this->payment_status) {
            case self::PAID:
                return '<span class="badge badge-success">PAID</span>';
                break;
            case self::PENDING:
                return '<span class="badge badge-warning">PENDING</span>';
                break;
            default:
                return '<span class="badge badge-warning">UNPAID</span>';
                break;
        }
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function campaign()
    {
        return $this->belongsTo('App\Models\Campaign');
    }

    public function payment_method()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    public function verify()
    {
        return $this->belongsTo('App\Models\User', 'verified_by');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', self::PAID);
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
}
