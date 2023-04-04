<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfert extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function comptebanks(){
        return $this->belongsTo(Comptebank::class, 'comptebank_id', 'id');
    }
}
