<?php

namespace App\Models;

use App\Models\Carte;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompteBank extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function comptebankable()
    {
        return $this->morphTo();
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

    public function cartes()
    {
        return $this->belongsToMany(Carte::class, 'carte__comptebanks','comptebank_id','carte_id')->withTimestamps();
    }

    public function versements(){
        return $this->hasMany(Versement::class, 'comptebank_id', 'id');
    }

    public function transferts(){
        return $this->hasMany(Transfert::class, 'comptebank_id', 'id');
    }
    public function retraits(){
        return $this->hasMany(Retrai::class, 'comptebank_id', 'id');
    }
    public function carte_comptebanks()
    {
        return $this->belongsToMany(Carte_Comptebank::class,'carte_id','comptebank_id');
    }
}
