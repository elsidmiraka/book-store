@extends('components.master')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="card shadow">
        <div class="p-4">
            <div class="d-flex justify-content-between align-items-baseline pb-2">
                <h5 class="fw-bold">Books table</h5>
                <a href="#" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#create-book">Add Book</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col" style="text-align:center">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td><a href="{{ route('book.details', $book->id) }}">#{{ $book->id}}</a></td>
                        <td>{{ $book->title }}</td>
                        <td><a href="{{ route('author.details', $book->author_id) }}">{{ $book->author->first_name}} {{ $book->author->last_name}}</a></td>
                        <td><img src="{{ asset('assets/images/'.$book->image) }}" alt="img" style="width: 50px;"></td>
                        <td>{{ $book->description}}</td>
                        <td>
                            <div class="d-flex justify-content-end">
                                @if ($book->trashed())
                                    <form action="{{ route('book.restore', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Are you sure?')">
                                            Restore
                                        </button>
                                    </form>
                                    <form action="{{ route('book.force_delete', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Are you sure?')">
                                            Delete Forever
                                        </button>
                                    </form>
                                @else    
                                    <form action="{{ route('book.delete', $book->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                    <a href="{{ route('book.edit', $book->id )}}" type="button" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <div></div>
                <div class="pt-2">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

  
  <!--Create book Modal -->
<div class="modal fade" id="create-book" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add new book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('book.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="author_id" class="form-label">Author</label>
                        <select class="form-select" id="mySelect" name="author_id">
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">
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
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <span class="input-group-text">0.00</span>
                            <input type="price" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                        </div>
                        @error('price')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                        @error('image')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div class="form-floating">
                            <textarea class="form-control" id="floatingTextarea" name="description" required></textarea>
                        </div>
                        @error('description')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
