<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiaire extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function beneficiaireable()
    {
        return $this->morphTo();
    }
}
