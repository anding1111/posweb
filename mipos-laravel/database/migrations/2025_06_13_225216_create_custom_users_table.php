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
        Schema::create('users', function (Blueprint $table) {
            // --- Start of schema definition ---
            $table->id(); // 'id' int(11) NOT NULL AUTO_INCREMENT - Laravel default
            $table->integer('uId')->unique(); // uId int(3) NOT NULL - Made unique as it seems like a user identifier
            $table->string('uFullName', 150); // uFullName varchar(150) NOT NULL
            $table->string('uName', 50)->unique(); // uName varchar(50) NOT NULL - Often used as login, so unique
            $table->string('uPassword', 255); // uPassword varchar(50) NOT NULL - Changed to 255 for Laravel hashing
            $table->string('uType', 10); // uType varchar(10) NOT NULL
            $table->boolean('uFlag'); // uFlag tinyint(1) NOT NULL
            $table->integer('softDelete'); // softDelete int(1) NOT NULL - Consider Laravel's SoftDeletes trait instead
            $table->integer('uAddedBy'); // uAddedBy int(4) NOT NULL
            $table->date('uEntryDate'); // uEntryDate date NOT NULL
            $table->integer('shId'); // shId int(8) NOT NULL
            // $table->rememberToken(); // Optional: if using Laravel's remember me feature
            // $table->timestamps(); // Optional: if we want Laravel to manage created_at/updated_at
            // Original table does not have created_at/updated_at, but uEntryDate exists.
            // --- End of schema definition ---
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
