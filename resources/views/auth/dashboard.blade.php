@extends('auth.layout')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </div>
                <div class="card-body text-center">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success fade show d-flex align-items-center" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @else
                        <div class="alert alert-info fade show d-flex align-items-center" role="alert">
                            <i class="fas fa-smile-beam me-2"></i>
                            <span>Welcome, <strong>{{ Auth::user()->name }}</strong>! You are logged in!</span>
                        </div>
                    @endif

                    <hr>

                    <a href="{{ route('books.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-book"></i> View Books
                    </a>

                    <a href="{{ route('logout') }}" class="btn btn-outline-danger ms-2">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
