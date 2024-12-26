<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookSwapRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;

class BookSwapController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
            'target_book_id' => 'required|exists:books,id',
        ]);

        $requesterId = auth()->id();

        $book = Book::find($validatedData['book_id']);
        $targetBook = Book::find($validatedData['target_book_id']);

        if ($targetBook->user_id == $requesterId) {
            return redirect()->back()->with('error', 'Kendi kitabınıza takas isteği gönderemezsiniz.');
        }

        $existingRequest = BookSwapRequest::where('book_id', $validatedData['book_id'])
            ->where('target_book_id', $validatedData['target_book_id'])
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'Bu takas isteği zaten mevcut.');
        }

        $swapRequest = BookSwapRequest::create([
            'book_id' => $validatedData['book_id'],
            'requester_id' => $requesterId,
            'target_book_id' => $targetBook->id,
            'status' => 'pending',
        ]);


        return redirect()->back()->with('success', 'Takas isteği başarıyla gönderildi!');

    }

    public function requests()
    {

        $sentRequests = BookSwapRequest::where('requester_id', Auth::id())
            ->where('status', 'pending')
            ->with('book.user', 'targetBook')
            ->get();


        $receivedRequests = BookSwapRequest::whereHas('targetBook', function ($query) {
            $query->where('user_id', Auth::id());
        })
            ->where('status', 'pending')
            ->with('book.user', 'requester', 'targetBook')
            ->get();

            
        return view('front.istekler', compact('sentRequests', 'receivedRequests'));
    }

}
