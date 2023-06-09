<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employe extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
}
