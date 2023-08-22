<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // protected $fillable is used to specify the fields that can be mass-assigned from Listing::create([]);
    protected $fillable = [
        'products',
        'quantity',
        'description',
        'address',
        'price',
    ];
}
