<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Cart extends Model
{
    use HasFactory;
    protected $table='carts';

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
          $carts = Cart::Where('user_id',Auth::id())
              ->orWhere('ip_address',request()->ip())
              ->where('order_id',NULL)
              ->get();
      }else{
          $carts = Cart::Where('ip_address',request()->ip())->where('order_id',NULL)->get();
      }


      return $carts;
    }



    /**
     * total items
     * @return integer  total item
     */
    public static function totalItems(){
        $carts= Cart::totalCarts();
       /* if(Auth::check()){
            $carts = Cart::Where('user_id',Auth::id())
                ->orWhere('ip_address',request()->ip())
                ->where('order_id',NULL)
                ->get();
        }else{
            $carts = Cart::Where('ip_address',request()->ip())->where('order_id',NULL)->get();
        }*/
        $total_item=0;
        foreach($carts as $cart){
            $total_item += $cart->product_quantity;
        }

        return $total_item;
    }

}
