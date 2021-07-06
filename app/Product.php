<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'merchant_id',
        'price',
        'status',
    ];

    public function merchants()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }
}
