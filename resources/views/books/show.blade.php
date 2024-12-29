<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Book Details</h1>
        <a href="{{ route('books.index') }}" class="btn btn-secondary mb-3">Back to Books List</a>

        <table class="table">
            <tr>
                <th>Title</th>
                <td>{{ $book->title }}</td>
            </tr>
            <tr>
                <th>Author</th>
                <td>{{ $book->author }}</td>
            </tr>
            <tr>
                <th>Year</th>
                <td>{{ $book->year }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $book->description }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>{{ $book->category->name ?? 'No category' }}</td> 
            </tr>
        </table>
    </div>
</body>
</html>
