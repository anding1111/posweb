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
        Schema::create('orders', function (Blueprint $table) {
            // --- Start of schema definition ---
            $table->id('cmId'); // cmId int(11) NOT NULL AUTO_INCREMENT
            $table->integer('invId'); // invId int(11) NOT NULL
            $table->integer('pId'); // pId int(11) NOT NULL
            $table->integer('cId'); // cId int(11) NOT NULL
            $table->integer('pPrice'); // pPrice int(11) NOT NULL
            $table->integer('pQty'); // pQty int(11) NOT NULL
            $table->integer('inCost'); // inCost int(11) NOT NULL
            $table->integer('pMount'); // pMount int(11) NOT NULL
            $table->integer('cPayment'); // cPayment int(11) NOT NULL
            $table->dateTime('bDate'); // bDate datetime NOT NULL
            $table->text('inSerial'); // inSerial varchar(15000) NOT NULL changed to text
            $table->integer('orEnable')->default(1); // orEnable int(2) NOT NULL DEFAULT '1'
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
        Schema::dropIfExists('orders');
    }
};
