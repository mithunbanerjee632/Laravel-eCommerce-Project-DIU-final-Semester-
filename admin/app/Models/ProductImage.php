<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    public $table ='product_images';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=true;
}
