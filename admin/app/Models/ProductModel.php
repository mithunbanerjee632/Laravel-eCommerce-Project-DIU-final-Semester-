<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model

{
    use HasFactory;

    public $table ='products';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;

    function images(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
}
