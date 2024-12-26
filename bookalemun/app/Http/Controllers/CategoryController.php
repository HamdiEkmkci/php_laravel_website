<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id)
    {

        $category = Category::findOrFail($id);
        $categories = Category::all();
        $books = Book::where('category_id', $category->id)->with('user')->get();

        if (Auth::user()) {
            return view('front.categories', compact('category', 'books'));
        }else{
            return  redirect('login')->with('message','Giriş yapınız!');
        }
    }
}

