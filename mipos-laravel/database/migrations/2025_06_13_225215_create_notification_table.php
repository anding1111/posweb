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
        Schema::create('notification', function (Blueprint $table) {
            // --- Start of schema definition ---
            $table->id('nId'); // nId int(11) NOT NULL AUTO_INCREMENT
            $table->string('nToWhom', 10); // nToWhom varchar(10) NOT NULL
            $table->integer('nFromWhom'); // nFromWhom int(4) NOT NULL
            $table->integer('newUserId'); // newUserId int(4) NOT NULL
            $table->string('nMessage', 255); // nMessage varchar(255) NOT NULL
            $table->dateTime('nDate'); // nDate datetime NOT NULL
            $table->integer('delete'); // delete int(1) NOT NULL
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
        Schema::dropIfExists('notification');
    }
};
