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
        Schema::create('shop', function (Blueprint $table) {
            // --- Start of schema definition ---
            $table->id('shId'); // shId int(9) NOT NULL AUTO_INCREMENT
            $table->string('shName', 50); // shName varchar(50) NOT NULL
            $table->string('shAuxName', 50)->default(''); // shAuxName varchar(50) NOT NULL DEFAULT ''
            $table->string('shDoc', 15); // shDoc varchar(15) NOT NULL
            $table->string('shTelf', 15); // shTelf varchar(15) NOT NULL
            $table->string('shDir', 80); // shDir varchar(80) NOT NULL
            $table->string('shMail', 50); // shMail varchar(50) NOT NULL
            $table->string('shWeb', 50); // shWeb varchar(50) NOT NULL
            $table->string('shDesc', 80); // shDesc varchar(80) NOT NULL
            $table->string('shColor', 10); // shColor varchar(10) NOT NULL
            $table->integer('shEnable')->default(1); // shEnable int(2) NOT NULL DEFAULT '1'
            // No timestamps needed
            // --- End of schema definition ---
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop');
    }
};
