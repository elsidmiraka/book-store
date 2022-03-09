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
                <h5 class="fw-bold">Authors table</h5>
                <a href="#" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#create-author">Add Author</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col" style="text-align:center">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ( $authors as $author ) 
                    <tr>
                        <td><a href="{{ route('author.details', $author->id) }}">#{{ $author->id}}</a></td>
                        <td>{{ $author->first_name}}</td>
                        <td>{{ $author->last_name}}</td>
                        <td>{{ $author->email}}</td>
                        <td>{{ $author->phone}}</td>
                        <td>
                            <div class="d-flex justify-content-end">
                                @if ($author->trashed())
                                    <form action="{{ route('author.restore', $author->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Are you sure?')">
                                            Restore
                                        </button>
                                    </form>
                                    <form action="{{ route('author.force_delete', $author->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Are you sure?')">
                                            Delete Forever
                                        </button>
                                    </form>
                                @else    
                                    <form action="{{ route('author.delete', $author->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                    <a href="{{ route('author.edit', $author->id )}}" type="button" class="btn btn-warning btn-sm">
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
                    {{ $authors->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

  
  <!--Create author Modal -->
<div class="modal fade" id="create-author" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add new author</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('author.save') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                        @error('first_name')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
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
