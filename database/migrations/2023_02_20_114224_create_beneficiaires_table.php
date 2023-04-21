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
        Schema::create('beneficiaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_beneficiaire');
            $table->string('prenom')->nullable();
            $table->string('cni');
            $table->string('telephone');
            $table->enum('sexe',["male","femmel"])->nullable();
            $table->morphs('beneficiaireable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaires');
    }
};
