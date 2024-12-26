<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Comment;

class HomeController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'book'])->orderBy('created_at', 'desc')->take(5)->get();
        $mostViewedBooks = Book::where('view_count', '>', 0)
            ->orderBy('view_count', 'desc')
            ->take(6)
            ->get();
        $mostSwappedBooks = Book::where('swapped_count', '>', 0)
            ->orderBy('view_count', 'desc')
            ->take(6)
            ->get();

        return view('front.index', compact('comments', 'mostViewedBooks', 'mostSwappedBooks'));
    }

    public function about()
    {
        return view("front.about");
    }

    public function logIn()
    {
        return view("front.login");
    }
    public function signIn()
    {
        return view("front.signin");
    }

    public function forgotPassword()
    {
        return view("front.forgotpassword");
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = Book::where('book_name', 'LIKE', "%{$query}%")
            ->orWhere('author', 'LIKE', "%{$query}%")
            ->with('user')
            ->get();

        return view('front.search-results', compact('books', 'query'));
    }

}
