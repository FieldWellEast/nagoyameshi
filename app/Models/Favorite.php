<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public static $rules = [
        'user_id' => 'nullable|exists:users,id',
        'shop_id' => 'required|exists:shops,id',
    ];

    protected $fillable = ['user_id', 'shop_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public static function destroyFavorite($id)
    {
        $favorite = self::findOrFail($id);
        $favorite->delete();

        return $favorite;
    }
}
