<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public  $fillable = [
        'user_id',
        'payment_id',
        'ip_address',
        'name',
        'email',
        'phone_no',
        'shipping_address',
        'division_id',
        'district_id',
        'zipcode',
        'message',
        'is_paid',
        'is_completed',
        'is_seen_by_admin',
        'transaction_id',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function payment(){
        return $this->belongsto(Payment::class);
    }
}
