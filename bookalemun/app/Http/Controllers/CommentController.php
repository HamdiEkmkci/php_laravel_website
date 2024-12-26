<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $book = Book::firstOrCreate(
            ['book_name' => $request->input('book_title')],
            [
                'book_author' => $request->input('author'),
                'book_p_c' => $request->input('page_count')
            ]
        );

        Comment::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('home')->with('success', 'Yorum başarıyla eklendi.');
    }

}
