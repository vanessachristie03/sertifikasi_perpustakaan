<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRental extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'book_id',
        'member_id', 
        'rent_date',
        'return_date',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
    
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
