<?php

namespace App\Models;


class TypePackage extends Model
{
    public function offers(){
        return $this->hasMany(Offer::class);
    }
}
