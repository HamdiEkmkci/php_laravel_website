<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'user_id',
        'category_id',
        'book_image',
        'book_name',
        'author',
        'page_count',
        'view_count',
        'swapped_count'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function swapRequests()
    {
        return $this->hasMany(BookSwapRequest::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

}
