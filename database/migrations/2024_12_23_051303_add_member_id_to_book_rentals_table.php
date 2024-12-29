<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMemberIdToBookRentalsTable extends Migration
{
    public function up()
    {
        Schema::table('book_rentals', function (Blueprint $table) {
            $table->unsignedBigInteger('member_id')->nullable()->after('book_id');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('book_rentals', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
            $table->dropColumn('member_id');
        });
    }
}
