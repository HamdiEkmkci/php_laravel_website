<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Request as BookRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function profileIndex()
    {
        return view('front.profile');
    }


    public function profileKitaplar()
    {
        $kitaplar = Auth::user()->books;
        $categories = Category::all();

        return view('front.kitaplar', compact('kitaplar', 'categories'));
    }


    public function profileMesajlar()
    {

        return view('front.mesajlar');
    }

}
