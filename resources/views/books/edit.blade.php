@extends('layouts.app')

@section('title', 'Edit Book')

@push('styles')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Book</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="cover_image" class="font-weight-bold">Cover Image</label>
                                <div>
                                    <input id="cover_image" type="file"
                                        class="form-control @error('cover_image') is-invalid @enderror" name="cover_image">
                                    @if($book->cover_image)
                                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Image"
                                            class="img-thumbnail mt-2" width="150">
                                    @endif
                                    @error('cover_image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Name</label>
                                <div>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', $book->name) }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category" class="font-weight-bold">Category</label>
                                <div>
                                    <select id="category" class="form-control @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="author" class="font-weight-bold">Author</label>
                                <div>
                                    <input id="author" type="text"
                                        class="form-control @error('author') is-invalid @enderror" name="author"
                                        value="{{ old('author', $book->author) }}">
                                    @error('author')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="font-weight-bold">Description</label>
                                <div>
                                    <textarea id="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        name="description">{{ old('description', $book->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="font-weight-bold">Price (RP)</label>
                                <div>
                                    <input id="price" type="number"
                                        class="form-control @error('price') is-invalid @enderror" name="price"
                                        value="{{ old('price', $book->price) }}" min="0" step="0.01">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="stock" class="font-weight-bold">Stock</label>
                                <div>
                                    <input id="stock" type="number"
                                        class="form-control @error('stock') is-invalid @enderror" name="stock"
                                        value="{{ old('stock', $book->stock) }}" min="0">
                                    @error('stock')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="is_published" class="font-weight-bold">Status</label>
                                <div>
                                    <select id="is_published" class="form-control" name="is_published">
                                        <option value="1" {{ old('is_published', $book->is_published) == 1 ? 'selected' : '' }}>Published</option>
                                        <option value="0" {{ old('is_published', $book->is_published) == 0 ? 'selected' : '' }}>Not Published</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endpush