@extends('components.master')   
@section('content')
<div class="container">
    <div class="card shadow mb-3">
        <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('assets/images/avatar.png') }}" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8 my-auto">
            <div class="card-body mx-4">
                <h5 class="card-title fw-bold">Edit Author</h5>
                <form action="{{ route('author.update', $author->id) }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $author->first_name }}">
                        @error('first_name')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $author->last_name }}">
                        @error('last_name')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $author->email }}">
                        @error('email')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ $author->phone }}">
                        @error('phone')
                            <label class="error text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                        @enderror
                    </div>
                    <div class="col-12 text-end">
                      <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                  </form>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection