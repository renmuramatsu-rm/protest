<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageRelation extends Model
{
    protected $table = 'message_relation';

    protected $fillable = [
        'user_id',
        'destination_user_id',
        'sold_item_id',
        'message_count',
    ];

    protected $casts = [
        'message_count' => 'integer'
    ];

}
