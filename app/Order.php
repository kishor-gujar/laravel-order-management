<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'city',
        'town',
        'quantity',
        'price',
        'product',
        'note',
        'specific',
        'date',
        'status_id',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function status() {
        return $this->belongsTo(Status::class, 'status_id');
    }
}












