<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopList extends Model
{
    use HasFactory;

    protected $table = 'shops'; // テーブル名を 'shops' に変更する

    protected $fillable = [
        'image',
        'shop_id',
        'name',
        'category_id',
        'price_upper',
        'price_lower',
        'start_time',
        'closings_time',
        'post_code',
        'address',
        'phone_number',
        'regular_holiday',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}