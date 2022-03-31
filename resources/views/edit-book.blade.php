@extends('components.master')   
@section('content')
<div class="container">
    <div class="card shadow mb-3">
        <div class="row g-0">
        <div class="col-md-4 my-auto">
            <div class="text-center">
                <img src="{{ asset('assets/images/book.png') }}" class="img-fluid rounded-start" alt="...">
            </div>
         </div>
        <div class="col-md-8 my-auto">
            <div class="card-body mx-4">
                <h5 class="card-title fw-bold">Edit Book</h5>
                <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}">
                        @error('title')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="author_id" class="form-label">Author</label>
                        <select class="form-select" id="mySelect" name="author_id">
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" @if ($author->id == $book->author_id) selected="selected" @endif>
                                    {{ $author->first_name }} {{ $author->last_name }}
                                </option>
                            @endForeach
                        </select>
                        @error('author_id')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <span class="input-group-text">0.00</span>
                            <input type="price" class="form-control" id="price" name="price" value="{{ $book->price }}" required>
                        </div>
                        @error('price')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                        @error('image')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <div class="form-floating">
                            <textarea class="form-control" id="floatingTextarea" name="description" required> {{ $book->description }}</textarea>
                        </div>
                        @error('description')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <a href="{{ route('books.index')}}">Back to books</a>
                             <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                    </div>
                  </form>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection