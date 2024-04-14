<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionAgreement extends Model
{
    // モデルが対応するテーブル名を定義する
    protected $table = 'subscription_agreements';

    // モデルの可変項目を定義する
    protected $fillable = [
        'content'
    ];
}
