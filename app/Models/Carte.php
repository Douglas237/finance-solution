<?php

namespace App\Models;

use App\Models\CompteBank;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carte extends Model
{
    use HasFactory;

    public function comptebanks()
    {
        return $this->belongsToMany(CompteBank::class);
    }

}
