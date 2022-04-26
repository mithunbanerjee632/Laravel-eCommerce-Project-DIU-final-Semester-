<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    public $table ='Categories';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=true;

    function products(){
        return $this->hasMany(ProductModel::class);
    }
}
