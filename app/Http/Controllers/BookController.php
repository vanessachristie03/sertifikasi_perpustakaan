<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\BookRental;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function rentallist()
    {
        
        $rentals = BookRental::with('book', 'member')->get();
        return view('books.rentallist', compact('rentals'));
    }
    
    public function index(Request $request)
    {
        $query = Book::query();
    
        // Jika ada query pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
    
        $books = $query->get();
        return view('books.index', compact('books'));
    }
    

    public function create()
    {
        $categories = Category::all(); 
        return view('books.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer|digits:4',
            'category_id' => 'required|exists:categories,category_id',
            'description' => 'required',
        ]);

        // Cek apakah buku dengan title dan author yang sama sudah ada
        $existingBook = Book::where('title', $request->title)
        ->where('author', $request->author)
        ->first();

        if ($existingBook) {
        return redirect()->back()->with('error', 'Book with this title and author already exists.');
        }
            Book::create([
                'title' => $request->title,
                'author' => $request->author,
                'year' => $request->year,
                'category_id' => $request->category_id,
                'description' => $request->description,
        ]);
        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    public function show($book_id)
    {
        $book = Book::with('category')->where('book_id', $book_id)->first();

    if (!$book) {
        return redirect()->route('books.index')->with('error', 'Book not found');
    }
        return view('books.show', compact('book'));
    }

    public function edit($book_id)
    {
        $book = Book::findOrFail($book_id);
        $categories = Category::all(); 
        return view('books.edit', compact('book', 'categories')); 
    }
    
    public function update(Request $request, Book $book)
    {

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer|digits:4',
            'category_id' => 'required|exists:categories,category_id', // Pastikan memvalidasi berdasarkan category_id
            'description' => 'required',
    ]);

    // Fungsi update
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'year' => 'required|integer|digits:4',
        'category_id' => 'required|exists:categories,category_id', // Pastikan memvalidasi berdasarkan category_id
        'description' => 'nullable',
    ]);


        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

}
