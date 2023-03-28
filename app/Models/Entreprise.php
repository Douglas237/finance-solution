<?php

namespace App\Models;

use App\Models\CompteBank;
use App\Models\Beneficiaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entreprise extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function beneficiaire()
    {
        return $this->morphOne(Beneficiaire::class, 'beneficiaireable');
    }

    public function comptebanks()
    {
        return $this->morphMany(CompteBank::class, 'comptebankable');
    }

}
