<?php

namespace App\Models;

use App\Models\Region;
use Illuminate\Database\Eloquent\Builder;


class Departement extends Model
{
    protected $fillable = ['name', 'region_id'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function farmers()
    {
        return $this->hasMany(Farmer::class);
    }

    public function agribusinesses(){
        return $this->hasMany(Agribusiness::class);
    }
}
