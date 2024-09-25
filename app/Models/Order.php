<?php

namespace App\Models;



class Order extends Model
{
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

}
