<?php

namespace App\Models;


class TypePackage extends Model
{
    public function offers(){
        return $this->hasMany(Offer::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

}
