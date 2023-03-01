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
        Schema::create('cartes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numero_carte');
            $table->integer('codesecret');
            $table->date('date_creation');
            $table->date('date_expiration');
            $table->enum('type', ["carte electron","carte visa","master carte"]);
            $table->boolean('statut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartes');
    }
};
