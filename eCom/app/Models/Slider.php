<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'sliders';

    public $fillable=[
        'title',
        'description',
        'price',
        'button_text',
        'button_link',
        'image',
        'priority'
    ];
}
