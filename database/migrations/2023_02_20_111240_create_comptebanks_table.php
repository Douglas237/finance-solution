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
        Schema::create('comptebanks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numero_compte');
            $table->string('solde');
            $table->enum('type_compte', ["Compte courant", "Compte epagne"]);
            $table->date('date_ouverture');
            $table->integer('code');
            $table->boolean('statut');
            $table->morphs('comptebankable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptebanks');
    }
};
