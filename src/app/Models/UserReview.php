<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    protected $fillable = [
        'user_id',
        'review'
    ];


    public function user()
    {
        return $this->belongTo(User::class, 'user_id', 'id');
    }
}
