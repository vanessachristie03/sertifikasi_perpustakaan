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
            'rent_date' => 'required|date',
            'return_date' => [
                'required',
                'date',
                'after_or_equal:rent_date',
                function ($attribute, $value, $fail) use ($request) {
                    $rentDate = $request->rent_date;
                    $maxReturnDate = \Carbon\Carbon::parse($rentDate)->addDays(7)->toDateString();
                    if ($value > $maxReturnDate) {
                        $fail('The return date must be within 7 days of the rent date.');
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
        BookRental::create([
            'book_id' => $validatedData['book_id'], 
            'member_id' => $member->id, 
            'name' => $validatedData['name'], 
            'rent_date' => $validatedData['rent_date'],
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
    
    
    
}
