<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Books List</h1>

        <!-- Search Form -->
        <div class="mb-4">
            <form action="{{ route('books.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by title" value="{{ request()->search }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <!-- Navigation Buttons -->
        <div class="mb-4 d-flex justify-content-between">
            <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">View Members</a>
            <a href="{{ route('rentallist') }}" class="btn btn-success">View Rentals List</a>
        </div>

        <!-- Books Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->year }}</td>
                    <td>
                        <a href="{{ route('books.show', $book->book_id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('books.edit', $book->book_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('books.rent', $book->book_id) }}" class="btn btn-success btn-sm">Rent</a>
                        <form action="{{ route('books.destroy', $book->book_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No books available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
