<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    protected $table = 'items';
    public $timestamps = false;

    protected $fillable = ['user_id', 'purchase_method','name', 'brandname', 'price', 'description', 'image', 'condition_id'];

    public function like_users()
    {
        return $this->belongsToMany(User::class, 'likes', 'item_id', 'user_id');
    }

    public function likes() {
        return $this->hasOne(Like::class);
    }

    public function comment_users()
    {
        return $this->belongsToMany(User::class, 'comments', 'item_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_category', 'item_id', 'category_id');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function sells()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sold()
    {
        return SoldItem::where('item_id', $this->id)->exists();
    }

    public function sold_item()
    {
        return $this->hasOne(SoldItem::class, 'item_id');
    }

    public function mine()
    {
        return $this->user_id == Auth::id();
    }

    public static function scopeItem($query, $item_name)
    {
        return $query->where('name', 'like', '%' . $item_name . '%');
    }
}
