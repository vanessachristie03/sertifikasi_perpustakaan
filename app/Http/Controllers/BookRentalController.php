<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookRental;
use App\Models\Member; 
use Illuminate\Http\Request;

class BookRentalController extends Controller
{
    public function index()
    {
    
        $rentals = BookRental::with('book', 'member')->get();
    
        return view('books.rentallist', compact('rentals'));
    }
    
    public function create(Book $book)
    {
        
        return view('books.rent', compact('book'));
    }

    public function store(Request $request)
{
    $existingMember = Member::where('email', $request->email)
        ->where('phone', $request->phone)
        ->first();

    $validatedData = $request->validate([
        'name' => 'required|string|min:4|max:255', 
        'email' => [
            'required',
            'email',
            'ends_with:@gmail.com',
            $existingMember ? 'nullable' : 'unique:members,email', 
        ],
        'phone' => [
            'required',
            'numeric',
            'min:10',
            $existingMember ? 'nullable' : 'unique:members,phone',
        ],
        'address' => 'required|string|min:15',
        'book_id' => 'required|exists:books,book_id',
        'return_date' => [
            'required',
            'date',
            'after_or_equal:' . now()->toDateString(),
            function ($attribute, $value, $fail) {
                $maxReturnDate = now()->addDays(7)->toDateString();
                if ($value > $maxReturnDate) {
                    $fail('The return date must be within 7 days of today.');
                }
            },
        ],
    ]);

    if (!$existingMember) {
        $member = Member::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
        ]);
    } else {
        $member = $existingMember;
    }

    // Tetapkan rent_date secara otomatis ke tanggal sekarang
    $rentDate = now()->toDateString();

    BookRental::create([
        'book_id' => $validatedData['book_id'], 
        'member_id' => $member->id, 
        'name' => $validatedData['name'], 
        'rent_date' => $rentDate, // Tanggal sekarang
        'return_date' => $validatedData['return_date'],
    ]);

    return redirect()->route('books.index')->with('success', 'Book rented successfully!');
}

    public function destroy($rental_id)
    {
        $rental = BookRental::findOrFail($rental_id);
        $rental->delete();

        return redirect()->route('rentallist')->with('success', 'Rental deleted successfully.');
    }
    public function markAsReturned($id)
{
    $rental = BookRental::findOrFail($id);
    $rental->is_returned = true; // Update kolom `is_returned` menjadi `true`
    $rental->save();

    return redirect()->route('rentallist')->with('success', 'Book marked as returned successfully!');
}

    
    
}
