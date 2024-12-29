<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function toggleCreateForm() {
            var createForm = document.getElementById("create-category-form");
            createForm.classList.toggle("d-none");
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Categories List</h1>


        <div class="mb-4 d-flex justify-content-between">
            <button class="btn btn-primary" onclick="toggleCreateForm()">Add New Category</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">View Books</a>
        </div>

        <div id="create-category-form" class="mb-4 d-none">
            <h2>Create New Category</h2>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Category</button>
                <button type="button" class="btn btn-secondary" onclick="toggleCreateForm()">Cancel</button>
            </form>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>

                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">No categories available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
