<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Book;
use \App\Models\Author;

class DisplayController extends Controller
{
    public function index(){

        //get all books with authors sorted by created_at desc and paginate
        $books = Book::with('author')->latest()->paginate(6);

        return view('index', compact('books'));
    }

    public function author_details($id){

        //find author with this id and get all datas, if not found throws an error  
        $author = Author::findOrFail($id);

        //get all books of related author
        $books = Book::with('author')->where('author_id', $id)->latest()->paginate(6);
    
        return view('author-details', compact('books', 'author'));
    }

    public function book_details($id){

        $book = Book::findOrFail($id);
    
        return view('book-details', compact('book'));
    }
}
