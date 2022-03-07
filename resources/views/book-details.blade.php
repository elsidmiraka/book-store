@extends('components.master')   
@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="row g-0">
          <div class="col-md-6">
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active" data-bs-interval="10000">
                    <img src="{{ asset('assets/images/book.png') }}" class="d-block w-75 mx-auto" alt="...">
                  </div>
                  <div class="carousel-item" data-bs-interval="2000">
                    <img src="{{ asset('assets/images/book3.jpeg') }}" class="d-block w-75 mx-auto" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('assets/images/book.png') }}" class="d-block w-75 mx-auto" alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
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