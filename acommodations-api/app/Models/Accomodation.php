<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'capacity',
        'rooms',
        'img_url',
        'price',
        'description',
        'disabled'
    ];
}
