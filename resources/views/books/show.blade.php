@extends('layouts.app')

@section('title', 'Book Detail')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-50 rounded">
                    </div>
                    <div class="text-right">
                        <div class="badge badge-primary p-2">{{ $book->is_published ? 'Published' : 'Not Published' }}</div>
                    </div>
                    <hr>
                    <h4>{{ $book->name }}</h4>
                    <p>{!! $book->description !!}</p>

                    <hr>
                    <div>
                        <strong>Price:</strong> <span class="text-success">Rp
                            {{ number_format($book->price, 0, ',', '.') }}</span>
                    </div>
                    <div>
                        <strong>Stock:</strong> <span class="text-info">{{ $book->stock }} available</span>
                    </div>

                    <hr>
                    <div class="text-right">
                        <i> Author: {{ $book->author }}</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection