<?php

namespace App\Models;



class Order extends Model
{
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function type_package()
    {
        return $this->belongsTo(TypePackage::class, 'type_package_id');
    }

 
}
