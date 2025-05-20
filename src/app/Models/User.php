<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'postcode',
        'address',
        'building',

    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmailJapanese);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function item_likes()
    {
        return $this->belongsToMany(Item::class, 'likes', 'user_id', 'item_id');
    }

    public function is_like($item_id){

        return $this->likes()->where('item_id', $item_id)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function item_comments()
    {
        return $this->belongsToMany(Comment::class, 'comments', 'user_id', 'item_id');
    }

    public function is_comment($item_id)
    {

        return $this->comments()->where('item_id', $item_id)->exists();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function purchases()
    {
        return $this->hasMany(Item::class, 'purchase_user_id');
    }

    public function sells()
    {
        return $this->hasMany(Item::class, 'user_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
