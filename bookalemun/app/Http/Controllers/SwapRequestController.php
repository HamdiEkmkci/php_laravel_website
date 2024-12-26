<?php

namespace App\Http\Controllers;

use App\Models\BookSwapRequest;
use Illuminate\Http\Request;

class SwapRequestController extends Controller
{
    public function accept(Request $request, $id)
    {

        $swapRequest = BookSwapRequest::find($id);

        if ($swapRequest && $swapRequest->targetBook->user_id == auth()->id()) {
            $swapRequest->status = 'accepted';
            $swapRequest->save();

            $book = $swapRequest->book;
            $book->user_id = $swapRequest->requester_id;
            $book->increment('swapped_count');
            $book->save();

            return response()->json(['success' => true, 'message' => 'İstek kabul edildi.']);
        } else {
            return response()->json(['success' => false, 'message' => 'İstek bulunamadı veya yetkiniz yok.']);
        }


    }


    public function reject(Request $request, $id)
    {
        $swapRequest = BookSwapRequest::find($id);

        if ($swapRequest && $swapRequest->book->user_id == auth()->id()) {
            $swapRequest->status = 'rejected';
            $swapRequest->save();

            return response()->json(['success' => true, 'message' => 'İstek reddedildi.']);
        } else {
            return response()->json(['success' => false, 'message' => 'İstek bulunamadı veya yetkiniz yok.']);
        }


    }

    public function deleteRequest($id)
    {
        $request = BookSwapRequest::find($id);
        if ($request && $request->requester_id == auth()->id()) { 
            $request->delete();
            return response()->json(['success' => true, 'message' => 'İstek başarıyla iptal edildi.']);
        }

        return response()->json(['success' => false, 'message' => 'İstek bulunamadı veya yetkiniz yok.']);
    }
}
