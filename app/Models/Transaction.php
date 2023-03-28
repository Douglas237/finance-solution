<?php

namespace App\Models;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function notification()
    {
        return $this->hasOne(Notification::class);
    }
}
