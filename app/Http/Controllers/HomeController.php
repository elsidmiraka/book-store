<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use \App\Models\Book;
use \App\Models\Author;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $authors = Author::latest()->paginate(10);

        return view('authors', compact('authors'));
    }

    public function create_author(Request $request)
    {
        
        $this->validate(request(), [
            'first_name' => 'required|min:2|max:50',
            'last_name'  => 'required|min:2|max:50',
            'email'      => 'required|email|unique:authors|string|max:255',
            'phone'      => 'required|min:3|max:15',
        ]);

        $author = new Author();
        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;
        $author->email = $request->email;
        $author->phone = $request->phone;
        $author->save();

        return redirect('/authors')->with('status', 'Author created successfully!');
    }

    public function edit_author($id)
    {

        $author = Author::findOrFail($id);

        return view('edit-author', compact('author'));
    }

    public function update_author(Request $request, $id)
    {
        
        $this->validate(request(), [
            'first_name' => 'required|min:2|max:50',
            'last_name'  => 'required|min:2|max:50',
            'email'      => ['required', 'string', 'email', 'max:255', Rule::unique('authors')->ignore($id),],
            'phone'      => 'required|min:3|max:15',
        ]);
        
        $author = Author::findOrFail($id);
        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;
        $author->email = $request->email;
        $author->phone = $request->phone;
        
        $author->save();

        return redirect('/authors')->with('status', 'Author updated successfully!');
    }

    public function books()
    {
        $books = Book::with('author')->latest()->paginate(10);

        return view('books', compact('books'));
    }
}
