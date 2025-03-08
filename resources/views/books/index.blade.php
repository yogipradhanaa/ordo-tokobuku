@extends('layouts.app')

@section('title', 'Books List')

@push('styles')
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">📚 Books List</h2>
        <a href="{{ route('books.create') }}" class="btn btn-success mb-3">ADD BOOK</a>

        <table class="table table-bordered" id="books-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cover</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#books-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('books.data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'cover_image', name: 'cover_image', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'author', name: 'author' },
                    { data: 'category', name: 'category' },
                    {
                        data: 'price', name: 'price', render: function (data) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(data);
                        }
                    },
                    { data: 'stock', name: 'stock' },
                    { data: 'is_published', name: 'is_published' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            // Delete Confirmation
            $(document).on('click', '.delete-btn', function () {
                if (confirm('Are you sure you want to delete this book?')) {
                    var bookId = $(this).data('id');
                    $.ajax({
                        url: '/books/' + bookId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endpush