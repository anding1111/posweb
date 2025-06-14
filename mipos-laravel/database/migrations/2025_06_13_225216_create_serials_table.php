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
        Schema::create('serials', function (Blueprint $table) {
            // --- Start of schema definition ---
            $table->id('seId'); // seId int(7) NOT NULL AUTO_INCREMENT
            $table->integer('pId'); // pId int(7) NOT NULL
            $table->integer('sId'); // sId int(7) NOT NULL
            $table->string('seSerial', 30); // seSerial varchar(30) NOT NULL
            $table->string('seAddedBy', 6); // seAddedBy varchar(6) NOT NULL
            $table->dateTime('seDate'); // seDate datetime NOT NULL
            $table->dateTime('seDateSale')->nullable(); // seDateSale datetime DEFAULT NULL
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
        Schema::dropIfExists('serials');
    }
};
