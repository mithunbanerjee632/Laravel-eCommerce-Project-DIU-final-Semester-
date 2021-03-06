<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public  $fillable = [
        'user_id',
        'ip_address',
        'name',
        'phone_no',
        'shipping_address',
        'email',
        'message',
        'is_paid',
        'is_completed',
        'is_seen_by_admin',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carts(){
        return $this->belongsto(Cart::class);
    }
}
