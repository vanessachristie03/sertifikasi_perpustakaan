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
        $lastBook = Book::orderBy('book_id', 'desc')->first();
        $nextNumber = $lastBook ? (intval(substr($lastBook->book_id, 1)) + 1) : 1;
        $newBookId = 'B' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        while (Book::where('book_id', $newBookId)->exists()) {
            $nextNumber++;
            $newBookId = 'B' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        }

        $book->book_id = $newBookId;
    });
}


}
