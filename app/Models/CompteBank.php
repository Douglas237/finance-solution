<?php

namespace App\Models;

use App\Models\Carte;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompteBank extends Model
{
    use HasFactory;

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
                    return $this->belongsToMany(Carte::class);
                }

}
