<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'brand_name',
        'price',
        'condition',
        'category',
        'item_image',
        'user_id',
    ];

    /**
     * 商品を出品したユーザー
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 商品へのコメント
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * 商品へのいいね
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedByAuthUser()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }
}
