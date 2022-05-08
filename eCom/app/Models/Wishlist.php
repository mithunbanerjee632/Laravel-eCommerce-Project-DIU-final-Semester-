<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wishlist extends Model
{
    use HasFactory;
    protected $table='wishlists';
    public  $fillable = [
        'user_id',
        'product_id',
        'ip_address'
        ];

    public function product(){
        return $this->belongsto(ProductModel::class);
    }
    public function users(){
        return $this->belongsto(User::class);
    }

    public static function totalWishlist(){
       if(Auth::check()){
           $wishlist = Wishlist::where('user_id',Auth::id())->count();
       }else{
           $wishlist = Wishlist::Where('ip_address',request()->ip())->count();
       }

        return $wishlist;
    }
}
