@extends('components.master')   
@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="row g-0">
          <div class="col-md-6 my-auto">
              <div class="text-center">
                  <img src="{{ asset('assets/images/book.png') }}" class="img-fluid rounded-start" style="max-width: 300px;" alt="...">
              </div>
          </div>
          <div class="col-md-6">
            <div class="card-body m-3">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div>
                        <h4 class="card-title">{{ $book->title }}</h4>
                        <h6 class="card-subtitle mb-3 text-muted">
                            by <a href="{{ route('author.details', $book->author_id) }}"><small class="fw-bold fst-italic">{{ $book->author->first_name }} {{ $book->author->last_name }}</small> </a>
                        </h6>
                        </h5>
                    </div>
                    <h6 class="card-subtitle mb-2 text-muted">
                        {{ $book->created_at->diffForHumans() }}
                    </h6>
                </div>
              <p class="card-text">
                    {{ $book->description }} <br>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                    when an unknown printer took a galley of type and scrambled it to make a type 
                    specimen book. It has survived not only five centuries, but also the leap into 
                    electronic typesetting, remaining essentially unchanged.
                </p>
                @auth
                    <h5 class="text-muted">${{ $book->price }}</h5>
                @endauth
                <div class="d-flex justify-content-between align-items-baseline">
                    @guest
                        <h5 class="text-muted">${{ $book->price }}</h5>
                        <a href="#" class="btn btn-sm btn-success">Add to card</a>
                    @else
                        <a href="#" class="btn btn-sm btn-warning">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                    @endguest
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="card">
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Comments</label>
        </div>
    </div>
</div>
@endsection