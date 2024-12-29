<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Book Rentals List</h1>
        <a href="{{ route('books.index') }}" class="btn btn-secondary mb-4">Back to Books List</a>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Book Title</th>
                    <th>Member Name</th>
                    <th>Rent Date</th>
                    <th>Return Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rentals as $rental)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rental->name }}</td>
                    <td>{{ $rental->book->title ?? 'N/A' }}</td>
                    <td>{{ $rental->member->name ?? 'N/A' }}</td>
                    <td>{{ $rental->rent_date }}</td>
                    <td>{{ $rental->return_date }}</td>
                    <td>
                        <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this rental?')">Delete</button>
                        </form>
                        
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No rentals available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
