<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'user_name',
        'user_fname',
        'user_lname',
        'email',
        'password',
        'profile_image',
        'favourite_aut',
        'favourite_book',
        'fb_page_count'
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }


    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
