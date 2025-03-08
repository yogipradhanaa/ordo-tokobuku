@extends('layouts.app')

@section('title', 'Edit Book')

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Book</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="font-weight-bold">Cover Image</label>
                            <input type="file" class="form-control @error('cover_image') is-invalid @enderror"
                                name="cover_image">
                            @error('cover_image')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name', $book->name) }}">
                            @error('name')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Author</label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror" name="author"
                                value="{{ old('author', $book->author) }}">
                            @error('author')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                name="description">{!! old('description', $book->description) !!}</textarea>
                            @error('description')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Price (RP)</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                                value="{{ old('price', $book->price) }}" min="0" step="0.01">
                            @error('price')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Stock</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock"
                                value="{{ old('stock', $book->stock) }}" min="0">
                            @error('stock')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Status</label>
                            <select class="form-control" name="is_published">
                                <option value="1" @selected(old('is_published', $book->is_published == 1))>Published</option>
                                <option value="0" @selected(old('is_published', $book->is_published == 0))>Not Published
                                </option>
                            </select>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Update Book</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
