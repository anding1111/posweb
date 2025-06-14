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
        Schema::create('items', function (Blueprint $table) {
            // --- Start of schema definition ---
            $table->id('pId'); // pId int(11) NOT NULL AUTO_INCREMENT
            $table->string('pBarCode', 50); // pBarCode varchar(50) NOT NULL
            $table->string('pName', 250); // pName varchar(250) NOT NULL
            $table->string('pIdBrand', 50); // pIdBrand varchar(50) NOT NULL
            $table->integer('pQuantity'); // pQuantity int(11) NOT NULL
            $table->integer('pCost'); // pCost int(11) NOT NULL
            $table->integer('pPrice'); // pPrice int(11) NOT NULL
            $table->integer('pEnable')->default(1); // pEnable int(2) NOT NULL DEFAULT '1'
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
        Schema::dropIfExists('items');
    }
};
