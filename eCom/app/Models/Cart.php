<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Cart extends Model
{
    use HasFactory;

    public  $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'ip_address',
        'name',
        'phone_no',


    ];

    public function users(){
        return $this->belongsto(User::class);
    }

    public function order(){
        return $this->belongsto(Order::class);
    }

    public function product(){
        return $this->belongsto(ProductModel::class);
    }
/**
 * total carts
 * @return integer  total cart Model
 */
    public static function totalCarts(){
      if(Auth::check()){
          $carts = Cart::orWhere('user_id',Auth::id())
              ->orWhere('ip_address',request()->ip())
              ->get();
      }else{
          $carts = Cart::orWhere('ip_address',request()->ip())->get();
      }


      return $carts;
    }



    /**
     * total items
     * @return integer  total item
     */
    public static function totalItems(){
        if(Auth::check()){
            $carts = Cart::orWhere('user_id',Auth::id())
                ->orWhere('ip_address',request()->ip())
                ->get();
        }else{
            $carts = Cart::orWhere('ip_address',request()->ip())->get();
        }
        $total_item=0;
        foreach($carts as $cart){
            $total_item += $cart->product_quantity;
        }

        return $total_item;
    }

}
