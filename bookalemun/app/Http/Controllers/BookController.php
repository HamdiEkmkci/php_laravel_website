<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    public function increaseViewCount(Request $request)
    {
        $bookId = $request->input('book_id');
        $book = Book::find($bookId);

        if ($book) {
            $book->increment('view_count');
            return response()->json(['success' => true, 'message' => 'View count updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Book not found.'], 404);
    }




    public function swappedCount($id)
    {
        $book = Book::find($id);

        if ($book) {

            $book->increment('swapped_count');
        }

        return response()->json(['success' => false, 'message' => 'Book not found'], 404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'book_name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'page_count' => 'required|integer',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($request->hasFile('book_image')) {
            $imagePath = $request->file('book_image')->store('assets/book_images', 'public');

            $validated['book_image'] = 'storage/' . $imagePath;
        }

        $validated['user_id'] = Auth::id();

        Book::create($validated);

        return redirect()->back()->with('success', 'Kitap başarıyla eklendi.');
    }
}
