<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destinataire extends Model
{
    use HasFactory;

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

}
