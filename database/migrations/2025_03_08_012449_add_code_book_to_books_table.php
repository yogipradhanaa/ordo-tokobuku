<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('code_book')->unique()->after('author')->nullable();
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('code_book');
        });
    }
};
