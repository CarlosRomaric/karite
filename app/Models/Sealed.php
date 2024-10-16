<?php

namespace App\Models;


class Sealed extends Model
{
    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer_sealed', 'sealed_id', 'offer_id');
    }
}
