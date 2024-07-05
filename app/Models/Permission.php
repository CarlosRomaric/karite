<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;

class Permission extends Model
{
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%'.$search.'%');
        });
    }

    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param Builder $builder
     */
    public function scopeRetrievingByUsersType(Builder $builder)
    {
        if (!auth()->user()->isPlateformAdmin() && !auth()->user()->isTraceAgriAdmin()) {
            $builder->whereNotIn('name', [
                    'ADMIN COOPERATIVE LIST', 'ADMIN COOPERATIVE ADD', 'ADMIN COOPERATIVE UPDATE', 'ADMIN COOPERATIVE DELETE',
                    'ADMIN PERMISSION LIST', 'ADMIN PERMISSION ADD', 'ADMIN PERMISSION UPDATE', 'ADMIN PERMISSION DELETE'
                ]
            );
        }
    }
}
