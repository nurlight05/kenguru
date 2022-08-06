<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'iin',
        'email',
        'number',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function getFullNameAttribute() {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getRatingAttribute() {
        $orders = $this->orders->load('feedback');
        $count = 0;
        $total = 0;
        $average = 0;
        foreach ($orders as $order) {
            if ($order->feedback()->exists() && $order->feedback->rating) {
                $count++;
                $total += $order->feedback->rating;
            }
        }
        if ($count > 0)
            $average = $total / $count;
        return $average;
    }
}
