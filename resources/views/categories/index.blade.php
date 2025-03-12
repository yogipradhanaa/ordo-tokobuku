<!DOCTYPE html>
<html lang="en">

@push('styles')
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Categories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color:#ffffff;
        text-align: center;
    }

    nav {
        background-color: #007bff;
        padding: 10px 0;
    }

    nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: center;
    }

    nav ul li {
        margin: 0 15px;
    }

    nav ul li a {
        text-decoration: none;
        color: white;
        font-size: 16px;
        font-weight: bold;
        padding: 10px 15px;
        display: inline-block;
        transition: background 0.3s;
    }

    nav ul li a:hover {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
    }

    .container {
        margin-top: 20px;
    }
</style>

<body>

    <nav>
        <ul>
            <li><a href="{{ url('/') }}">Dashboard</a></li>
            <li><a href="{{ url('/books') }}">Books</a></li>
            <li><a href="{{ url('/categories') }}">Categories</a></li>
        </ul>
    </nav>

    <div class="container mt-5 mb-5">
        @yield('content')
    </div>

    <div class="container mt-4">
        <h2 class="text-center">Categories</h2>

        <form id="addCategoryForm">
            <div class="input-group mb-3">
                <input type="text" id="categoryName" class="form-control" placeholder="Enter category name" required>
                <button class="btn btn-success" type="submit">Add Category</button>
            </div>
        </form>

        <table id="categoriesTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $index => $category)
                    <tr data-id="{{ $category->id }}">
                        <td>{{ $index + 1 }}</td>
                        <td class="category-name">{{ $category->name }}</td>
                        <td>
                            <button class="btn btn-primary btn-edit" data-id="{{ $category->id }}"
                                data-name="{{ $category->name }}">Edit</button>
                            <button class="btn btn-danger btn-delete" data-id="{{ $category->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editForm">
                    <div class="modal-body">
                        <input type="hidden" id="edit-id">
                        <label>Category Name:</label>
                        <input type="text" class="form-control" id="edit-name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            let categoryId;

            // Inisialisasi DataTables
            $('#categoriesTable').DataTable();

            // Tambah kategori
            $('#addCategoryForm').submit(function (e) {
                e.preventDefault();
                let name = $('#categoryName').val();
                $.post("{{ route('categories.store') }}", { name: name, _token: "{{ csrf_token() }}" }, function (response) {
                    alert(response.success);
                    location.reload();
                });
            });

            // Show modal edit
            $(document).on('click', '.btn-edit', function () {
                categoryId = $(this).data('id');
                $('#edit-id').val(categoryId);
                $('#edit-name').val($(this).data('name'));
                $('#editModal').modal('show');
            });

            // Update kategori
            $('#editForm').submit(function (e) {
                e.preventDefault();
                let name = $('#edit-name').val();
                $.ajax({
                    url: `/categories/${categoryId}`,
                    type: 'PUT',
                    data: { _token: "{{ csrf_token() }}", name: name },
                    success: function (response) {
                        alert(response.success);
                        location.reload();
                    }
                });
            });

            // Show modal delete
            $(document).on('click', '.btn-delete', function () {
                categoryId = $(this).data('id');
                $('#deleteModal').modal('show');
            });

            // Delete kategori
            $('#confirm-delete').click(function () {
                $.ajax({
                    url: `/categories/${categoryId}`,
                    type: 'DELETE',
                    data: { _token: "{{ csrf_token() }}" },
                    success: function (response) {
                        alert(response.success);
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>
</html>

