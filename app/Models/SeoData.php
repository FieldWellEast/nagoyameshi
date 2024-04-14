<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoData extends Model
{
    protected $table = 'seo_data'; 

    protected $fillable = ['page_name', 'title', 'description']; 

    
}
