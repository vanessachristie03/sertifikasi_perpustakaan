<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIdTypeInBooksTable extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            // Mengubah kolom id menjadi string
            $table->string('book_id', 10)->change();  // Ubah ukuran sesuai dengan format id yang diinginkan (misalnya B001)
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            // Mengembalikan kolom id ke integer
            $table->integer('book_id')->change();
        });
    }
}
