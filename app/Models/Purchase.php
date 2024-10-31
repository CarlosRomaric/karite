<?php

namespace App\Models;

class Purchase extends Model
{
    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    public function agribusiness()
    {
        return $this->belongsTo(Agribusiness::class);
    }
}
