<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'member_id', 'store_id', 'reservation_date', 'people_count'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }


}