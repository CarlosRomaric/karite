<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Certification extends Model
{
    use HasFactory;

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function agribusinesses()
    {
        return $this->hasMany(Agribusiness::class, 'agribusiness_id');
    }
}
