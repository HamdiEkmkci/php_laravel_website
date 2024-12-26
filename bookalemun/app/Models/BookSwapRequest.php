<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookSwapRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'requester_id',
        'book_id',
        'status',
        'target_book_id',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function targetBook()
    {
        return $this->belongsTo(Book::class, 'target_book_id');
    }

}

