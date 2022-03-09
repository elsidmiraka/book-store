<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Book;
use \App\Models\Author;

class DisplayController extends Controller
{
    public function index(){

        //get all books with authors where author is not soft deleted sorted by created_at desc and paginate
        $books = Book::whereHas('author', function($query){
            $query->where('deleted_at', NULL);
       })->latest()->paginate(6);

        return view('index', compact('books'));
    }
}
