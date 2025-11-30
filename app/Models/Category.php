<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =
    [
        "icon",
        "title",
        "slug"
    ];


    function products()
    {
        return $this->hasMany(Product::class);
    }
}
