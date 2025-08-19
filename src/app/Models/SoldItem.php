<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldItem extends Model
{
    use HasFactory;

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sold_item_id');
    }

    public function messageCounts()
    {
        return $this->hasMany(MessageRelation::class, 'sold_item_id');
    }

    protected $fillable = [
        'buyer_id',
        'seller_id',
        'item_id',
        'postcode',
        'address',
        'building',
        'status'
    ];
}
