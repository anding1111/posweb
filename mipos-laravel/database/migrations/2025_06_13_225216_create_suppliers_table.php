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
        Schema::create('suppliers', function (Blueprint $table) {
            // --- Start of schema definition ---
            $table->id('sId'); // sId int(11) NOT NULL AUTO_INCREMENT
            $table->string('sName', 250); // sName varchar(250) NOT NULL
            $table->double('sDoc'); // sDoc double NOT NULL
            $table->double('sTelf'); // sTelf double NOT NULL
            $table->string('sDir', 250); // sDir varchar(250) NOT NULL
            $table->string('sAddedBy', 7); // sAddedBy varchar(7) NOT NULL
            $table->dateTime('sEntryDate'); // sEntryDate datetime NOT NULL
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
        Schema::dropIfExists('suppliers');
    }
};
