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
        Schema::create('retrais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('comptebank_id');
            $table->string('num_compte');
            $table->string('montant_retrait');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retrais');
    }
};
