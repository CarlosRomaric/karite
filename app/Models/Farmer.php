<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;

class Farmer extends Model
{
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('fullname', 'like', '%'.$search.'%');
            $query->orWhere('born_date', 'like', '%'.$search.'%');
            $query->orWhere('born_place', 'like', '%'.$search.'%');
            $query->orWhere('locality', 'like', '%'.$search.'%');
            $query->orWhere('phone', 'like', '%'.$search.'%');
            $query->orWhere('marital_status', 'like', '%'.$search.'%');
            $query->orWhere('identifier', 'like', '%'.$search.'%');
            $query->orWhere('gps_code', 'like', '%'.$search.'%');
            $query->orWhereHas('agribusiness', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });
    }

    public function plots()
    {
        return $this->hasMany(Plot::class);
    }

    public function agribusiness()
    {
        return $this->belongsTo(Agribusiness::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    
    

    /**
     * @param Builder $builder
     */
    public function scopeRetrievingByUsersType(Builder $builder)
    {
        if (!auth()->user()->isTraceAgriAdmin() && !auth()->user()->isPlateformAdmin()) {
            $builder->where('agribusiness_id', auth()->user()->agribusiness_id);
        }
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
