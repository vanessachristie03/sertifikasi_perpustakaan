<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeyFromBookRentalsTable extends Migration
{
    public function up()
    {
        // Hapus foreign key constraint
        Schema::table('book_rentals', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
        });
    }

    public function down()
    {
        // Jika migrasi di-rollback, tambahkan kembali foreign key
        Schema::table('book_rentals', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }
}
