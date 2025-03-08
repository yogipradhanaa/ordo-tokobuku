<?php

namespace App\Models;

use Carbon\Traits\LocalFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use LocalFactory;

    protected $fillable = [
        'cover_image',
        'name',
        'author',
        'code_book',
        'price',
        'stock',
        'description',
        'is_published',  
    ];
}
