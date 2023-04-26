<?php

namespace App\Models;

use App\Models\CompteBank;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carte extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function comptebanks()
    {
        return $this->belongsToMany(CompteBank::class,'carte__comptebanks','carte_id','comptebank_id')->withTimestamps();
    }
    public function carte_comptebanks()
    {
        return $this->belongsToMany(Carte_Comptebank::class,'carte_id','comptebank_id');
    }

}
