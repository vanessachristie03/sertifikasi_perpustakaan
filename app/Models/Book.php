<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $primaryKey = 'book_id';
    public $incrementing = false;
    protected $keyType = 'string'; // Ubah keyType menjadi string
    protected $fillable = ['title', 'author', 'year', 'description', 'category_id'];

    // Relasi ke Category
   // Model Book
public function category()
{
    return $this->belongsTo(Category::class, 'category_id', 'category_id'); // Relasi berdasarkan category_id
}

    public static function boot()
{
    parent::boot();

    static::creating(function ($book) {
        // Generate ID otomatis (B001, B002, dst.)
        $lastBook = Book::orderBy('book_id', 'desc')->first();

        // Mengambil angka dari book_id, mengonversinya ke integer, lalu menambahkannya
        $nextNumber = $lastBook ? (intval(substr($lastBook->book_id, 1)) + 1) : 1;

        // Tentukan book_id dengan menambahkan angka yang sudah diformat
        $newBookId = 'B' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Cek apakah book_id yang dihasilkan sudah ada
        while (Book::where('book_id', $newBookId)->exists()) {
            // Jika sudah ada, tambahkan 1 lagi ke angka
            $nextNumber++;
            $newBookId = 'B' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        }

        // Assign book_id yang unik
        $book->book_id = $newBookId;
    });
}

    
//     public function bookRentals()
// {
//     return $this->hasMany(BookRental::class, 'book_id', 'book_id');
// }

}
