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
        Schema::create('purchases', function (Blueprint $table) {
            // --- Start of schema definition ---
            $table->id('puId'); // puId int(11) NOT NULL AUTO_INCREMENT
            $table->integer('suId'); // suId int(7) NOT NULL
            $table->integer('puTotal'); // puTotal int(11) NOT NULL
            $table->integer('puPayment'); // puPayment int(11) NOT NULL
            $table->string('puAddedBy', 6); // puAddedBy varchar(6) NOT NULL
            $table->dateTime('puDate'); // puDate datetime NOT NULL
            $table->string('puInvPurchase', 20); // puInvPurchase varchar(20) NOT NULL
            $table->string('puDetail', 100); // puDetail varchar(100) NOT NULL
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
        Schema::dropIfExists('purchases');
    }
};
