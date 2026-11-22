<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasusPenyakit extends Model
{
    protected $guarded = [];

    public function getTotalAttribute(): int
    {
        return $this->jun + $this->jul + $this->agu + $this->sep;
    }
}