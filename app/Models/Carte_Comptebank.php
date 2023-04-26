<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carte_Comptebank extends Model
{
    use HasFactory;
    public function comptebanks()
    {
        return $this->belongsToMany(CompteBank::class);
    }
    public function cartes()
    {
        return $this->belongsToMany(Carte::class);
    }

    public function down():void
    {
        Schema::dropIfExists('carte__comptebanks');
    }
}
