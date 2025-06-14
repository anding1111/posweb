<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('logouttime', function (Blueprint $table) {
            // --- Start of schema definition ---
            $table->id(); // id int(11) NOT NULL AUTO_INCREMENT
            $table->integer('uId'); // uId int(4) NOT NULL
            $table->dateTime('logoutTime'); // logoutTime datetime NOT NULL
            $table->integer('shId'); // shId int(8) NOT NULL
            // No timestamps needed
            // --- End of schema definition ---
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logouttime');
    }
};
