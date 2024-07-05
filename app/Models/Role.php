<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;

class Role extends Model
{
    public function agribusiness()
    {
        return $this->belongsTo(Agribusiness::class);
    }

    public function roles()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%'.$search.'%');
            $query->orWhereHas('agribusiness', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
                $query->orWhere('acronym', 'like', "%{$search}%");
            });
        });
    }

    /**
     * Role Permission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    /**
     * Grant the given permission to a role.
     *
     * @param  Permission $permission
     * @return mixed
     */
    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }

    /**
     * Grant the given permission to a role.
     *
     * @param  Permission $permission
     * @return mixed
     */
    public function hasPermission(Permission $permission)
    {
        return $this->permissions()->get()->whereIn('id', $permission->id)->isNotEmpty();
    }

    /**
     * @param Builder $builder
     */
    public function scopeRetrievingByUsersType(Builder $builder)
    {
        $builder->where('agribusiness_id', auth()->user()->agribusiness_id);
//        if (!auth()->user()->isTraceAgriAdmin() || !auth()->user()->isPlateformAdmin()) {
//            $builder->where('agribusiness_id', auth()->user()->agribusiness_id);
//        } else {
//            $builder->whereHas('roles', function ($q) {
//                $q->whereIn('name', ['ADMINISTRATEUR TRACEAGRI', 'ADMINISTRATEUR PLATEFORME', 'ADMINISTRATEUR COOPERATIVE']);
//            });
//        }
    }

}
