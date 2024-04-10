<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Reservation; // Reservationモデルをインポート

class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'name', 'category_id', 'description', 'price_upper', 'price_lower', 'start_time', 'closings_time', 'post_code', 'address', 'phone_number', 'regular_holiday'];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}