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
        Schema::create('carte__comptebanks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('comptebank_id')->constrained('compte_bans');
            $table->foreignId('carte_id')->constrained('cartes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carte__comptebanks');
    }
};
