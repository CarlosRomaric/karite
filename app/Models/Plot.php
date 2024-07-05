<?php

namespace App\Models;


class Plot extends Model
{
    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
