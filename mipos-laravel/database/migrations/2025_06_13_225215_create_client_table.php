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
        Schema::create('client', function (Blueprint $table) {
            // --- Start of schema definition ---
            $table->id('cId'); // cId int(11) NOT NULL AUTO_INCREMENT
            $table->string('cName', 250); // cName varchar(250) NOT NULL
            $table->string('cDoc', 255); // cDoc varchar(255) NOT NULL
            $table->double('cTelf'); // cTelf double NOT NULL
            $table->string('cDir', 250); // cDir varchar(250) NOT NULL
            $table->string('cEmail', 250); // cEmail varchar(250) NOT NULL
            $table->integer('cViewInv'); // cViewInv int(2) NOT NULL
            $table->string('cAddedBy', 4); // cAddedBy varchar(4) NOT NULL
            $table->dateTime('cEntryDate'); // cEntryDate datetime NOT NULL
            $table->integer('clEnable')->default(1); // clEnable int(2) NOT NULL DEFAULT '1'
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
        Schema::dropIfExists('client');
    }
};
