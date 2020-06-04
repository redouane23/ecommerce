<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);

    } // end of clients

    public function products()
    {

        return $this->belongsToMany(Product::class, 'product_cart')->withPivot('quantity');

    } // end of products
}
