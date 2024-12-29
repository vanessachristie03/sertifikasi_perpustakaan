<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookRentalsTable extends Migration
{
    public function up()
    {
        Schema::create('book_rentals', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama penyewa
            $table->foreignId('book_id')->constrained()->onDelete('cascade'); // Relasi ke tabel books
            $table->date('rent_date'); // Tanggal pinjam
            $table->date('return_date'); // Tanggal kembali
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_rentals');
    }
}
