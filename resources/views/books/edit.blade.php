<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Edit Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Book</h1>
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

        <form action="{{ route('books.update', $book->book_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    class="form-control" 
                    value="{{ old('title', $book->title) }}" 
                    required
                >
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input 
                    type="text" 
                    name="author" 
                    id="author" 
                    class="form-control" 
                    value="{{ old('author', $book->author) }}" 
                    required
                >
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input 
                    type="number" 
                    name="year" 
                    id="year" 
                    class="form-control" 
                    value="{{ old('year', $book->year) }}" 
                    required
                >
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select 
                    name="category_id" 
                    id="category_id" 
                    class="form-control" 
                    required
                >
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->category_id }}" 
                            {{ old('category_id', $book->category_id) == $category->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea 
                    name="description" 
                    id="description" 
                    class="form-control"
                >{{ old('description', $book->description) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
