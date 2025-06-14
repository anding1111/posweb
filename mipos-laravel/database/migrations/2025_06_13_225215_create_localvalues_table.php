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
        Schema::create('localvalues', function (Blueprint $table) {
            // --- Start of schema definition ---
            $table->id('vaId'); // vaId int(11) NOT NULL AUTO_INCREMENT
            $table->string('vaData', 50)->unique(); // vaData varchar(50) NOT NULL, UNIQUE KEY
            // No timestamps needed
            // --- End of schema definition ---
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localvalues');
    }
};
