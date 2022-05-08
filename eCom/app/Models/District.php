<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';

    public $fillable=[
       'name',
        'division_id'
    ];

    public function Division(){
        return $this->belongsTo(Division::class);
    }
}
