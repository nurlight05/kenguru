<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'status',
        'courier_id',
        'sum_to_pay',
        'current_lon',
        'current_lat',
        'from_street',
        'from_building',
        'from_room_number',
        'from_floor',
        'from_intercom',
        'from_long',
        'from_lat',
        'to_street',
        'to_building',
        'to_room_number',
        'to_floor',
        'to_intercom',
        'to_long',
        'to_lat',
        'vehicle_type',
    ];

    public function payment() {
        return $this->belongsTo(Payment::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function courier() {
        return $this->belongsTo(Courier::class);
    }

    public function feedback() {
        return $this->hasOne(Feedback::class);
    }

    public function getStatusTextAttribute() {
        $status = $this->status;
        if ($status == 1)
            return 'created';
        if ($status == 2)
            return 'in_process';
        if ($status == 3)
            return 'finished';
        return '-';
    }
}
