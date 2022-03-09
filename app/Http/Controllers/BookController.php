<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use \App\Models\Book;
use \App\Models\Author;

class BookController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $books = Book::whereHas('author', function($query){
             $query->where('deleted_at', NULL);
        })->withTrashed()->latest()->paginate(10);

        // dd($books);

        $authors = Author::all()->where('deleted_at', NULL);

        return view('books', compact('books','authors'));
    }

    public function book_details($id){

        $book = Book::findOrFail($id);
    
        return view('book-details', compact('book'));
    }

    public function create_book(Request $request)
    {

        $this->validate(request(), [
            'title'         => 'required|min:2|max:100',
            'author_id'     => 'required',
            'price'         => 'required',
            'image'         => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'description'   => 'required|min:2|max:255',
        ]);

        $new_image_name = time(). '-' .$request->title. '-' .$request->image->extension();
        $request->image->move(public_path('assets/images'), $new_image_name);
        
        $book = new Book();
        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->price = $request->price;
        $book->image = $new_image_name;
        $book->description = $request->description;
        // dd($book->image);

        $book->save();

        return redirect()->route('books.index')->with('status', 'Book created successfully!');
    }

    public function edit_book($id)
    {

        $book = Book::findOrFail($id);

        $authors = Author::all();

        // dd($book->author_id);

        return view('edit-book', compact('book', 'authors'));
    }

    public function update_book(Request $request, $id)
    {
        
        $this->validate(request(), [
            'title'         => 'required|min:2|max:100',
            'author_id'     => 'required',
            'price'         => 'required',
            'image'         => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'description'   => 'required|min:2|max:255',
        ]);
        $new_image_name = time(). '-' .$request->title. '-' .$request->image->extension();
        $request->image->move(public_path('assets/images'), $new_image_name);

        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->price = $request->price;
        $book->image = $new_image_name;
        $book->description = $request->description;
        
        $book->save();

        return redirect()->route('books.index')->with('status', 'Book updated successfully!');
    }


    public function destroy($id){

        $book = Book::findOrFail($id);

        $book->delete();

        return redirect()->route('books.index');
    }

    public function restore($id){

        $book = Book::onlyTrashed()->findOrFail($id);

        $book->restore();

        return redirect()->route('books.index');
    }

    public function forceDelete($id){

        $book = Book::onlyTrashed()->findOrFail($id);

        $book->forceDelete();

        return redirect()->route('books.index');
    }
}
