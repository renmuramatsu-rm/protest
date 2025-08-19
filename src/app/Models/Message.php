<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'text',
        'img_url',
        'user_id',
        'sold_item_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function soldItem()
    {
        return $this->belongsTo(soldItem::class);
    }
}
