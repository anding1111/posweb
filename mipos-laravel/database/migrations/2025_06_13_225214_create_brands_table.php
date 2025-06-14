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
        Schema::create('brands', function (Blueprint $table) {
            // --- Start of schema definition ---
            $table->id('bId'); // bId int(11) NOT NULL AUTO_INCREMENT
            $table->string('bName', 50); // bName varchar(50) NOT NULL
            $table->integer('shId'); // shId int(8) NOT NULL
            // No timestamps needed as per original schema
            // $table->timestamps();
            // --- End of schema definition ---
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
