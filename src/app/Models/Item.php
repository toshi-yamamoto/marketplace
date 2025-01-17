<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',        // 商品名
        'image_url',   // 画像パス
        'user_id',     // 出品者ID
    ];

    // 出品者（ユーザー）とのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
