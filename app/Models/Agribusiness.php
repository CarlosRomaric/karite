<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;

class Agribusiness extends Model
{

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%'.$search.'%');
            $query->orWhere('acronym', 'like', '%'.$search.'%');
            $query->orWhere('address', 'like', '%'.$search.'%');
            $query->orWhere('person_responsible_name', 'like', '%'.$search.'%');
            $query->orWhere('person_responsible_phone', 'like', '%'.$search.'%');
        });
    }

    public function scopeRetrievingByUsersType(Builder $builder)
    {
        if (!auth()->user()->isTraceAgriAdmin() && !auth()->user()->isPlateformAdmin()) {
            $builder->where('id', auth()->user()->agribusiness_id);
        }
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function farmers(){
        return $this->hasMany(Farmer::class);
    }


    public function offers(){
        return $this->hasMany(Offer::class);
    }


}
