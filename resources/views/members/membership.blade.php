<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a Member</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Register as a Member</h1>
        <a href="{{ route('books.index') }}" class="btn btn-secondary mb-3">Back to Books</a>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('members.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
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
                <label for="phone" class="form-label">Phone Number</label>
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
                    rows="3" 
                    class="form-control"
                    required>{{ old('address') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
