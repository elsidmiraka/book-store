
@extends('components.master')   
@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($books as $book)
            <div class="col">
                <div class="card shadow h-100">
                    <img src="{{ asset('assets/images/'.$book->image) }}" class="card-img-top px-5 py-4 mx-auto img" alt="book">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <div>
                                <h5 class="card-title">
                                    <a href="{{ route('book.details', $book->id) }}">{{ $book->title }}</a>
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
                            <h5 class="text-muted">${{ $book->price }}</h5>
                            <a href="#" class="btn btn-sm btn-success">Add to cart</a>
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
        
