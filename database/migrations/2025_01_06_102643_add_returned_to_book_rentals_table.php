<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('book_rentals', function (Blueprint $table) {
            $table->boolean('is_returned')->default(false)->after('return_date'); // Kolom untuk mencatat status pengembalian
        });
    }
    
    public function down()
    {
        Schema::table('book_rentals', function (Blueprint $table) {
            $table->dropColumn('is_returned'); // Hapus kolom jika migrasi di-rollback
        });
    }
    
};
