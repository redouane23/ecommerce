<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    protected $guarded = [];

    protected $casts = [
        'phone' => 'array'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
