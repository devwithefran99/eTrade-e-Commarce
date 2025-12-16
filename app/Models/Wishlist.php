<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['customer_id', 'product_id'];

    // Product relation
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

// class Wishlist extends Model
// {
//     protected $fillable = ['customer_id', 'product_id'];

//     public function product()
//     {
//         return $this->belongsTo(Product::class);
//     }

//     // যদি আপনার customer model থাকে:
//     public function customer()
//     {
//         return $this->belongsTo(Customer::class);
//     }
// }
