<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class VendorModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'vendor';

    protected $fillable = [
       'name',
       'email',
       'password',
   ];

   protected $hidden = [
       'password',
       'remember_token',
   ];
}
