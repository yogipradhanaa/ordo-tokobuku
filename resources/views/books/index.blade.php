<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Books List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Books List</h2>
        <a href="{{ route('books.create') }}" class="btn btn-success mb-3">ADD BOOK</a>

        <table class="table table-bordered" id="books-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cover</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                            alert(response.success);
                            $('#books-table').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
