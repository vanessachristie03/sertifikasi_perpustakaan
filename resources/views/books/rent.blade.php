<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Rent Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Rent a Book: {{ $book->title }}</h1>
        <a href="{{ route('books.index') }}" class="btn btn-secondary mb-3">Back</a>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.rent.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="form-control" 
                    value="{{ old('name') }}" 
                    required
                >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control" 
                    value="{{ old('email') }}" 
                    required
                >
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input 
                    type="text" 
                    name="phone" 
                    id="phone" 
                    class="form-control" 
                    value="{{ old('phone') }}" 
                    required
                >
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea 
                    name="address" 
                    id="address" 
                    class="form-control" 
                    required>{{ old('address') }}</textarea>
            </div>
        
            <div class="mb-3">
                <label for="book_title" class="form-label">Book Title</label>
                <input type="text" class="form-control" value="{{ $book->title }}" readonly>
                <input type="hidden" name="book_id" value="{{ $book->book_id }}">
            </div>
            
            <div class="mb-3">
                <label for="rent_date" class="form-label">Rent Date</label>
                <input 
                    type="date" 
                    name="rent_date" 
                    id="rent_date" 
                    class="form-control" 
                    value="{{ old('rent_date', now()->format('Y-m-d')) }}" 
                    readonly
                >
            </div>
      
            <div class="mb-3">
                <label for="return_date" class="form-label">Return Date</label>
                <input 
                    type="date" 
                    name="return_date" 
                    id="return_date" 
                    class="form-control" 
                    value="{{ old('return_date', now()->addDays(7)->format('Y-m-d')) }}" 
                    required
                >
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
