<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name',
        'author',
        'publisher',
        'publish-date',
        'price',
        'stock',
        'cover_book'
    ];
}
