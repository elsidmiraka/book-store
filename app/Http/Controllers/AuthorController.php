<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use \App\Models\Book;
use \App\Models\Author;

class AuthorController extends Controller
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

    public function index(Request $request)
    {
        
        $authors = Author::latest()
            // ->when($request->has('archive'), function($query){
            //     $query->onlyTrashed();
            // })
            ->withTrashed()
            ->paginate(10);

        return view('authors', compact('authors'));
    }

    public function author_details($id){

        //find author with this id and get all datas, if not found throws an error  
        $author = Author::findOrFail($id);

        //get all books of related author
        $books = Book::with('author')->where('author_id', $id)->latest()->paginate(6);
    
        return view('author-details', compact('books', 'author'));
    }

    public function destroy($id){

        $author = Author::findOrFail($id);

        $author->delete();

        return redirect()->route('authors.index');
    }

    public function restore($id){

        $author = Author::onlyTrashed()->findOrFail($id);

        $author->restore();

        return redirect()->route('authors.index');
    }

    public function forceDelete($id){

        $author = Author::onlyTrashed()->findOrFail($id);

        $author->forceDelete();

        return redirect()->route('authors.index');
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

        return redirect()->route('authors.index')->with('status', 'Author created successfully!');
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

        return redirect()->route('authors.index')->with('status', 'Author updated successfully!');
    }
}
