<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);

    } // end of clients

    public function products()
    {

        return $this->belongsToMany(Product::class, 'product_order')->withPivot('quantity', 'price');

    } // end of products

}
