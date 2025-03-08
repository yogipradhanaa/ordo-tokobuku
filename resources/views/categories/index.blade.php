@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Categories</h2>

    <!-- Form Tambah Kategori -->
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
            <button class="btn btn-success" type="submit">Add Category</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel Kategori -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Category Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
