@extends('components.master')   
@section('content')
<div class="container">
    <div class="card shadow mb-3">
        <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('assets/images/avatar.png') }}" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body mx-4">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="card-title fw-bold fst-italic">{{ $author->first_name }} {{ $author->last_name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $author->email }}</h6>
                </div>
                <p class="card-text text-muted"> phone: <span class="fst-italic fw-bold">{{ $author->phone }}</span></p>
            </div>
            <p class="card-text">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type
                specimen book. It has survived not only five centuries, but also the leap into
                electronic typesetting, remaining essentially unchanged.
            </p>
            <p class="card-text"><small class="text-muted">Authors place of birth and birthdate</small></p>
            </div>
        </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($books as $book)
            <div class="col">
                <div class="card shadow h-100">
                    <img src="{{ asset('assets/images/'.$book->image) }}" class="card-img-top px-5 py-4 mx-auto img" alt="book">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <div>
                                <h5 class="card-title">
                                    <a href="#">{{ $book->title }}</a>
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                        by <a href="{{ route('author.details', $book->author_id ) }}">{{ $book->author->first_name }} {{ $book->author->last_name }}</a>
                                </h6>
                            </div>
                            <div>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    {{ $book->created_at->diffForHumans() }}
                                </h6>
                            </div>
                        </div>
                        <p class="card-text">
                            {{ $book->description }}
                        </p>
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
        @endforeach
    </div>
    <div class="d-flex justify-content-between">
        <div></div>
        <div class="mt-4">
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection