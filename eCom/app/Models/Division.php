<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $table = 'divisions';

    public $fillable=[
        'name',
        'priority'
    ];

    function districts(){
        return $this->hasMany(District::class);
    }
}
